<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PleskAPI extends Controller
{
    //


    static function createUser($data)
    {


        $xml = '<?xml version="1.0" encoding="UTF-8" standalone="no" ?>
                <packet>
                <ip>
                  <get/>
                </ip>
                </packet>';
        $resip = self::exec($xml);

        if (isset($resip->ip->get->result->addresses->ip_info)) {
            if (isset($resip->ip->get->result->addresses->ip_info->ip_address)) {

                $ip = $resip->ip->get->result->addresses->ip_info->ip_address;
            } else {
                $ips = $resip->ip->get->result->addresses->ip_info[0];
                $ip = $ips->ip_address;
            }


            $xml = '<?xml version="1.0" encoding="UTF-8" standalone="no" ?>
        <packet>
            <customer>
                <add>
                    <gen_info>
                        <pname>' . $data['last_name'] . ' ' . $data['first_name'] . '</pname>
                        <login>' . $data['username'] . '</login>
                        <passwd>' . $data['passwordplesk'] . '</passwd>
                        <email>' . $data['email'] . '</email>
                    </gen_info>
                </add>
            </customer>
        </packet>';
            $res = self::exec($xml);


            if ((isset($res->customer->add->result->errcode) && $res->customer->add->result->errcode == '1007') || (isset($res->customer->add->result->status) && $res->customer->add->result->status == 'ok')) {

                if ($res->customer->add->result->status == 'ok') {
                    $user = Auth::user()->find($data['id']);
                    $user->plesk_id = $res->customer->add->result->id;
                    $user->plesk_password = $data['passwordplesk'];
                    $plesk_id = $res->customer->add->result->id;
                    $user->save();
                } else if ($res->customer->add->result->errcode == '1007') {
                    $user = Auth::user()->find($data['id']);
                    $plesk_id = $user->plesk_id;
                }


                $xml = '<?xml version="1.0" encoding="UTF-8" standalone="no" ?>
        <packet>
        <webspace>
            <add>
                <gen_setup>
                    <name>' . $data['hostname'] . '</name>
                    <owner-id>' . $plesk_id . '</owner-id>
                          <ip_address>IP ADRESS</ip_address>
                    <htype>vrt_hst</htype>
                          <status>0</status>
                </gen_setup>
                <hosting>
                    <vrt_hst>
                        <property>
                            <name>ftp_login</name>
                            <value>' . $data['hostname'] . '</value>
                        </property>
                        <property>
                            <name>ftp_password</name>
                            <value>' . $data['password'] . '</value>
                        </property>
                        <ip_address>' . "IP ADRESS" . '</ip_address>
                    </vrt_hst>
                </hosting>
                <plan-name>' . $data['billing_name'] . '</plan-name>
            </add>
        </webspace>
        </packet>';


                $res2 = self::exec($xml);

                if (isset($res->webspace->add->result->status) && $res->customer->add->result->status == 'ok') {
                    Session::put('success', 'Produit livré !');
                    return Redirect::to('/order');
                }

            }


        }

    }

    public function suspendDomain($domain)
    {
        $xml = '<?xml version="1.0" encoding="UTF-8" standalone="no" ?>
					<packet>
					<webspace>
					<set>
					<filter>
					<name>'.$domain.'</name>
					</filter>
					<values>
					<gen_setup>
					<status>256</status>
					</gen_setup>
					</values>
					</set>
					</webspace>
					</packet>
					';
        $res = $this->exec($xml);

    }
    public function unsuspendDomain($domain){
        $xml = '<?xml version="1.0" encoding="UTF-8" standalone="no" ?>
                <packet>
                <webspace>
                    <set>
                        <filter>
                            <name>'.$domain.'</name>
                        </filter>
                        <values>
                            <gen_setup>
                                <status>0</status>
                            </gen_setup>
                        </values>
                    </set>
                </webspace>
                </packet>';
        $res = $this->exec($xml);

    }


    private static function exec($request)
    {
        $headers = array(
            "Content-Type: text/xml",
            "HTTP_PRETTY_PRINT: TRUE",
        );

		// TODO Insert keys
        $headers[] = "KEY: ";
        $headers[] = "HTTP_AUTH_LOGIN:";
        $headers[] = "HTTP_AUTH_PASSWD:";


        $curl = curl_init();
		// TODO Insert Plesk URL
        curl_setopt($curl, CURLOPT_URL, "https://plesk.url/enterprise/control/agent.php");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
        $result = curl_exec($curl);
        curl_close($curl);
        $result = simplexml_load_string($result);
        return json_decode(json_encode($result));
    }
}
