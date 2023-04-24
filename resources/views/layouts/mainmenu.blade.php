<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow"data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand"href="/html/ltr/vertical-menu-template/index.html">
                    <div class="brand-logo"><img class="logo"src="/app-assets/images/logo/apple-touch-icon.png" /></div>
                    <h2 class="brand-text mb-0" style="color: black">FSI</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0"data-toggle="collapse"><i
                        class="bx bx-x d-block d-xl-none font-medium-4 primary"></i><i
                        class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary"
                        data-ticon="bx-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main"id="main-menu-navigation"data-menu="menu-navigation"
            data-icon-style="lines">
            <li><a href="/"><i class="bx bxs-home"></i><span class="menu-item"
                        data-i18n="eCommerce">Beranda</span></a>
            </li>
            <li class="navigation-header"><span>Shop</span>
            </li>
            <li class="nav-item"><a href="/katalog"><i
                        class="menu-livicon"data-icon="morph-folder"></i><span
                        class="menu-title"data-i18n="Catalog">Catalog</span></a>
            </li>
            <li class="nav-item"><a href="/keranjangku"><i
                        class="menu-livicon"data-icon="shoppingcart-in"></i><span
                        class="menu-title"data-i18n="Pesananku">Pesananku</span></a>
            </li>
            <li class="nav-item"><a href="/transaksi"><i
                        class="menu-livicon"data-icon="credit-card-out"></i><span
                        class="menu-title"data-i18n="Transaksi">Data Transaksi</span></a>
            </li>

            <li class="navigation-header"><span>UI Elements</span>
                @role('admin')
                <li class="navigation-header"><span>Master Data</span>
                </li>
                <li class="nav-item"><a href="/master/katalog"><i
                            class="menu-livicon"data-icon="box"></i><span
                            class="menu-title"data-i18n="File Manager">Data Katalog</span></a>
                </li>
                <li class="nav-item"><a href="/master/size"><i
                            class="menu-livicon"data-icon="calculator"></i><span
                            class="menu-title"data-i18n="File Manager">Data Size dan Harga</span></a>
                </li>       
                <li class="nav-item"><a href="/master/transaksi"><i
                    class="menu-livicon"data-icon="calculator"></i><span
                    class="menu-title"data-i18n="File Manager">Data Pemesan</span></a>
        </li>                
            @endrole()
        </ul>
    </div>
</div>
