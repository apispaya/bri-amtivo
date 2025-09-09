 <!-- Page Sidebar Start-->
 <div class="sidebar-wrapper" data-sidebar-layout="stroke-svg">
     <div>
         <div class="logo-wrapper"><a href="#"><img class="img-fluid for-light"
                     src="<?php echo e(asset('assets/images/logo/logo_crop.png')); ?>" style="height: 35px" alt=""><img
                     class="img-fluid for-dark" src="<?php echo e(asset('assets/images/logo/logo_crop.png')); ?>" style="height: 35px"
                     alt=""></a>
             <div class="back-btn"><i class="fa-solid fa-angle-left"></i></div>
             <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
         </div>
         <div class="logo-icon-wrapper"><a href="#"><img class="img-fluid"
                     src="<?php echo e(asset('assets/images/logo/logo_crop.png')); ?>" style="height: 35px" alt=""></a>
         </div>
         <nav class="sidebar-main">
             <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
             <div id="sidebar-menu">
                 <ul class="sidebar-links" id="simple-bar">
                     <li class="back-btn">
                         <div class="mobile-back text-end"><span>Back</span><i class="fa-solid fa-angle-right ps-2"
                                 aria-hidden="true"></i></div>
                     </li>
                     <li class="pin-title sidebar-main-title">
                         <div>
                             <h6>Pinned</h6>
                         </div>
                     </li>
                     <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i><a
                             class="sidebar-link sidebar-title link-nav" href="<?php echo e(route('dashboard.home')); ?>">
                             <svg class="stroke-icon">
                                 <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#stroke-home')); ?>"></use>
                             </svg>
                             <svg class="fill-icon">
                                 <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#fill-home')); ?>"></use>
                             </svg><span>Dashboard</span></a>
                     </li>
                     <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i><a
                             class="sidebar-link sidebar-title link-nav" href="<?php echo e(route('dashboard.users.index')); ?>">
                             <svg class="stroke-icon">
                                 <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#stroke-user')); ?>"></use>
                             </svg>
                             <svg class="fill-icon">
                                 <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#fill-user')); ?>"></use>
                             </svg><span>Users</span></a>
                     </li>
                     <li class="sidebar-main-title">
                         <div>
                             <h6>CLIENT</h6>
                         </div>
                     </li>
                     <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i><a
                             class="sidebar-link sidebar-title link-nav" href="<?php echo e(route('dashboard.client-certs.index')); ?>">
                             <svg class="stroke-icon">
                                 <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#stroke-client')); ?>"></use>
                             </svg>
                             <svg class="fill-icon">
                                 <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#stroke-client')); ?>"></use>
                             </svg><span>Client's Certification</span></a>
                     </li>
                     <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i><a
                             class="sidebar-link sidebar-title link-nav" href="#">
                             <svg class="stroke-icon">
                                 <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#profile-check')); ?>"></use>
                             </svg>
                             <svg class="fill-icon">
                                 <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#profile-check')); ?>"></use>
                             </svg><span>Client Assessment</span></a>
                     </li>
                     <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i><a
                             class="sidebar-link sidebar-title link-nav" href="#">
                             <svg class="stroke-icon">
                                 <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#client-meeting')); ?>"></use>
                             </svg>
                             <svg class="fill-icon">
                                 <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#client-meeting')); ?>"></use>
                             </svg><span>Training Segment</span></a>
                     </li>
                     <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i><a
                             class="sidebar-link sidebar-title link-nav" href="#">
                             <svg class="stroke-icon">
                                 <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#c-invoice')); ?>"></use>
                             </svg>
                             <svg class="fill-icon">
                                 <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#c-invoice')); ?>"></use>
                             </svg><span>Endorsement</span></a>
                     </li>
                     <li class="sidebar-main-title">
                         <div>
                             <h6>BRI AMTIVO COMPLIANCE</h6>
                         </div>
                     </li>
                 </ul>
             </div>
             <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
         </nav>
     </div>
 </div>
 <!-- Page Sidebar Ends-->
<?php /**PATH /var/www/html/bri-amtivo/resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>