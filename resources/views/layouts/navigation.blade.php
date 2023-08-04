<aside class="bg-white position-fixed vh-100 cs-navigation">
    <div>
        {{-- Hamburger menu --}}
        <div class="float-end">
            <img src="{{ URL::asset('img/hamburger.svg') }}" alt="menu" />
        </div>

        {{-- Logo --}}
        <div>
            <img class="cs-logo" src="{{ URL::asset('img/logo.svg') }}" alt="logo" />
        </div>

        {{-- Menus --}}
        <div class="overflow-scroll cs-menus">
            <nav class="cs-nav-menu">
                <ul>
                    <li>
                        <a href="#">
                            <img class="h-auto icon" src="{{ URL::asset('img/icon-dashboard.svg') }}" alt="Dashboard">
                            <span class="label">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img class="h-auto icon" src="{{ URL::asset('img/icon-setting.svg') }}" alt="Pengaturan Umum">
                            <span class="label">Pengaturan Umum</span>
                            <img class="h-auto arrow" src="{{ URL::asset('img/arrow-down.svg') }}" alt="Toggle">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img class="h-auto icon" src="{{ URL::asset('img/icon-media.svg') }}" alt="Manajemen Banner">
                            <span class="label">Manajemen Banner</span>
                            <img class="h-auto arrow" src="{{ URL::asset('img/arrow-down.svg') }}" alt="Toggle">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img class="h-auto icon" src="{{ URL::asset('img/icon-product.svg') }}" alt="Produk">
                            <span class="label">Produk</span>
                            <img class="h-auto arrow" src="{{ URL::asset('img/arrow-down.svg') }}" alt="Toggle">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img class="h-auto icon" src="{{ URL::asset('img/icon-sales.svg') }}" alt="Penjualan">
                            <span class="label">Penjualan</span>
                            <img class="h-auto arrow" src="{{ URL::asset('img/arrow-down.svg') }}" alt="Toggle">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img class="h-auto icon" src="{{ URL::asset('img/icon-customer.svg') }}" alt="Pelanggan">
                            <span class="label">Pelanggan</span>
                            <img class="h-auto arrow" src="{{ URL::asset('img/arrow-down.svg') }}" alt="Toggle">
                        </a>

                        <ul>
                            <li>
                                <a href="#">
                                    <span class="label">Daftar Pelanggan</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label">Manajemen B2B</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <img class="h-auto icon" src="{{ URL::asset('img/icon-partnership.svg') }}" alt="Partner Marketing Data">
                            <span class="label">Partner Marketing Data</span>
                            <img class="h-auto arrow" src="{{ URL::asset('img/arrow-down.svg') }}" alt="Toggle">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img class="h-auto icon" src="{{ URL::asset('img/icon-feedback.svg') }}" alt="Feedback & Survey">
                            <span class="label">Feedback & Survey</span>
                            <img class="h-auto arrow" src="{{ URL::asset('img/arrow-down.svg') }}" alt="Toggle">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img class="h-auto icon" src="{{ URL::asset('img/icon-notification.svg') }}" alt="Alert & Notification">
                            <span class="label">Alert & Notification</span>
                            <img class="h-auto arrow" src="{{ URL::asset('img/arrow-down.svg') }}" alt="Toggle">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img class="h-auto icon" src="{{ URL::asset('img/icon-chat.svg') }}" alt="Chat & Inbox">
                            <span class="label">Chat & Inbox</span>
                            <img class="h-auto arrow" src="{{ URL::asset('img/arrow-down.svg') }}" alt="Toggle">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img class="h-auto icon" src="{{ URL::asset('img/icon-review.svg') }}" alt="Ulasan Emitmen & Berita">
                            <span class="label">Ulasan Emitmen & Berita</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img class="h-auto icon" src="{{ URL::asset('img/icon-badge.svg') }}" alt="Promosi">
                            <span class="label">Promosi</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img class="h-auto icon" src="{{ URL::asset('img/icon-tags.svg') }}" alt="Manajemen Voucher">
                            <span class="label">Manajemen Voucher</span>
                            <img class="h-auto arrow" src="{{ URL::asset('img/arrow-down.svg') }}" alt="Toggle">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img class="h-auto icon" src="{{ URL::asset('img/icon-analytic.svg') }}" alt="Analytic">
                            <span class="label">Analytic</span>
                            <img class="h-auto arrow" src="{{ URL::asset('img/arrow-down.svg') }}" alt="Toggle">
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</aside>