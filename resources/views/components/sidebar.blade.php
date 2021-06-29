@if(Str::contains(Route::current()->getName(),"admin"))
    <div class="nav-application clearfix">
        <a href="/dashboard"
           class="btn btn-square text-sm <?php echo e(request()->is('dashboard') ? 'active' : ''); ?>">
            <span class="btn-inner--icon d-block"><i class="fas fa-arrow-left"></i></span>
            <span class="btn-inner--icon d-block pt-2">Retour</span>
        </a>

        <a href="/services"
           class="btn btn-square text-sm <?php echo e(request()->is('admin/services') ? 'active' : ''); ?>">
            <span class="btn-inner--icon d-block"><i class="fas fa-boxes"></i></span>
            <span class="btn-inner--icon d-block pt-2">Services</span>
        </a> <a href="/discounts"
                class="btn btn-square text-sm <?php echo e(request()->is('admin/discounts') ? 'active' : ''); ?>">
            <span class="btn-inner--icon d-block"><i class="fas fa-coins"></i></span>
            <span class="btn-inner--icon d-block pt-2">Promos</span>
        </a>
    </div>
@else

    <div class="nav-application clearfix">
        <a href="/dashboard"
           class="btn btn-square text-sm <?php echo e(request()->is('dashboard') ? 'active' : ''); ?>">
            <span class="btn-inner--icon d-block"><i class="far fa-home fa-2x"></i></span>
            <span class="btn-inner--icon d-block pt-2">Accueil</span>
        </a>
        <a href="/services" class="btn btn-square text-sm <?php echo e(request()->is('services') ? 'active' : ''); ?>">
            <span class="btn-inner--icon d-block"><i class="far fa-project-diagram fa-2x"></i></span>
            <span class="btn-inner--icon d-block pt-2">Mes Services</span>
        </a>

        <a href="/order" class="btn btn-square text-sm <?php echo e(request()->is('order') ? 'active' : ''); ?>">
            <span class="btn-inner--icon d-block"><i class="far fa-columns fa-2x"></i></span>
            <span class="btn-inner--icon d-block pt-2">Commander</span>
        </a>
        <a href="javascript:void(Tawk_API.toggle())" class="btn btn-square text-sm">
            <span class="btn-inner--icon d-block"><i class="far fa-users-cog fa-2x"></i></span>
            <span class="btn-inner--icon d-block pt-2">Support</span>
        </a>

        <a href="/invoices" class="btn btn-square text-sm <?php echo e(request()->is('invoices') ? 'active' : ''); ?>">
            <span class="btn-inner--icon d-block"><i class="far fa-receipt fa-2x"></i></span>
            <span class="btn-inner--icon d-block pt-2">Factures</span>
        </a>
        <a href="/profile" class="btn btn-square text-sm <?php echo e(request()->is('profile') ? 'active' : ''); ?>">
            <span class="btn-inner--icon d-block"><i class="far fa-user-ninja fa-2x"></i></span>
            <span class="btn-inner--icon d-block pt-2">Mon profil</span>
        </a>

    </div>
@endif
