@extends('components.template')

@section('content')
    <style>
        .hover-card:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.25);
        }
    </style>
    <div class="content-body" style="min-height: 100%">
        <!-- row -->
        <div class="container-fluid mh-auto">
            <div class="row">
                <div class="col-xl-12">
                    <div class="overflow-hidden bg-transparent dz-crypto-scroll shadow-none">
                        <div class="js-conveyor-example">
                            <ul class="crypto-list" id="crypto-webticker">
                                <li>
                                    <div class="card overflow-hidden">
                                        <div class="card-body d-flex align-items-center">
                                            <div class="me-4">
                                                <p class="mb-2 fs-13"><i class="fa fa-caret-up scale5 me-2 text-success"
                                                        aria-hidden="true"></i>4%(30 days)</p>
                                                <h4 class="heading mb-0">$65,123</h4>
                                            </div>
                                            <svg width="42" height="42" viewBox="0 0 42 42" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M28.5 16.5002C28.4986 14.844 27.156 13.5018 25.5003 13.5H16.5002V19.4999H25.5003C27.156 19.4985 28.4986 18.1559 28.5 16.5002Z"
                                                    fill="#FFAB2D" />
                                                <path
                                                    d="M16.5002 28.5H25.5003C27.1569 28.5 28.5 27.157 28.5 25.5003C28.5 23.8432 27.1569 22.5001 25.5003 22.5001H16.5002V28.5Z"
                                                    fill="#FFAB2D" />
                                                <path
                                                    d="M21 0.00012207C9.4021 0.00012207 9.15527e-05 9.40213 9.15527e-05 21C9.15527e-05 32.5979 9.4021 41.9999 21 41.9999C32.5979 41.9999 41.9999 32.5979 41.9999 21C41.9866 9.40762 32.5924 0.0133972 21 0.00012207ZM31.5002 25.4998C31.4961 28.8122 28.8122 31.4961 25.5003 31.4998V32.9998C25.5003 33.8284 24.8283 34.4999 24.0002 34.4999C23.1716 34.4999 22.5001 33.8284 22.5001 32.9998V31.4998H19.5004V32.9998C19.5004 33.8284 18.8284 34.4999 18.0003 34.4999C17.1717 34.4999 16.5002 33.8284 16.5002 32.9998V31.4998H12.0004C11.1718 31.4998 10.5003 30.8282 10.5003 30.0001C10.5003 29.1716 11.1718 28.5 12.0004 28.5H13.5V13.5H12.0004C11.1718 13.5 10.5003 12.8285 10.5003 11.9999C10.5003 11.1714 11.1718 10.4998 12.0004 10.4998H16.5002V9.00021C16.5002 8.17166 17.1717 7.50012 18.0003 7.50012C18.8288 7.50012 19.5004 8.17166 19.5004 9.00021V10.4998H22.5001V9.00021C22.5001 8.17166 23.1716 7.50012 24.0002 7.50012C24.8287 7.50012 25.5003 8.17166 25.5003 9.00021V10.4998C28.7998 10.4861 31.486 13.1494 31.5002 16.4489C31.5075 18.1962 30.7499 19.8593 29.4265 21C30.7375 22.128 31.4942 23.77 31.5002 25.4998Z"
                                                    fill="#FFAB2D" />
                                            </svg>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="card overflow-hidden">
                                        <div class="card-body d-flex align-items-center">
                                            <div class="me-4">
                                                <p class="mb-2 fs-13"><i class="fa fa-caret-down scale5 me-2 text-danger"
                                                        aria-hidden="true"></i>4%(30 days)</p>
                                                <h4 class="heading mb-0">$65,123</h4>
                                            </div>
                                            <svg width="42" height="42" viewBox="0 0 42 42" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M21 0.00012207C9.4021 0.00012207 9.15527e-05 9.40213 9.15527e-05 21C9.15527e-05 32.5979 9.4021 41.9999 21 41.9999C32.5979 41.9999 41.9999 32.5979 41.9999 21C41.9871 9.40762 32.5924 0.0129395 21 0.00012207ZM12.3281 19.4999H18.328C19.1566 19.4999 19.8281 20.1715 19.8281 21C19.8281 21.8286 19.1566 22.5001 18.328 22.5001H12.3281C11.4996 22.5001 10.828 21.8286 10.828 21C10.828 20.1715 11.5 19.4999 12.3281 19.4999ZM31.0841 17.3658L29.28 26.392C28.8552 28.4872 27.0155 29.9951 24.8777 30.0001H12.3281C11.4996 30.0001 10.828 29.3286 10.828 28.5C10.828 27.6715 11.5 26.9999 12.3281 26.9999H24.8777C25.5868 26.9981 26.197 26.4982 26.338 25.8033L28.1425 16.7772C28.3027 15.9715 27.7799 15.1887 26.9747 15.0285C26.8791 15.0097 26.782 15.0001 26.685 15.0001H15.3283C14.4998 15.0001 13.8282 14.3286 13.8282 13.5C13.8282 12.6715 14.4998 11.9999 15.3283 11.9999H26.685C29.1633 12.0009 31.1715 14.01 31.1711 16.4883C31.1711 16.7827 31.1418 17.0765 31.0841 17.3658Z"
                                                    fill="#3693FF" />
                                            </svg>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="card overflow-hidden">
                                        <div class="card-body d-flex align-items-center">
                                            <div class="me-4">
                                                <p class="mb-2 fs-13"><i class="fa fa-caret-down scale5 me-2 text-danger"
                                                        aria-hidden="true"></i>4%(30 days)</p>
                                                <h4 class="heading mb-0">$65,123</h4>
                                            </div>
                                            <svg width="42" height="42" viewBox="0 0 42 42" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M21 0.00012207C9.4021 0.00012207 9.15527e-05 9.40213 9.15527e-05 21C9.15527e-05 32.5979 9.4021 41.9999 21 41.9999C32.5979 41.9999 41.9999 32.5979 41.9999 21C41.9871 9.40762 32.5924 0.0129395 21 0.00012207ZM26.9999 30.0001H22.5001V34.4999C22.5001 35.3285 21.8286 36 21 36C20.1714 36 19.4999 35.3285 19.4999 34.4999V30.0001H15.0001C14.1715 30.0006 13.4995 29.3295 13.4991 28.5009C13.4991 28.1599 13.6149 27.8289 13.8282 27.5625L23.8784 15.0001H15.0001C14.1715 15.0001 13.5 14.3286 13.5 13.5C13.5 12.6715 14.1715 11.9999 15.0001 11.9999H19.4999V7.50012C19.4999 6.67157 20.1714 6.00003 21 6.00003C21.8286 6.00003 22.5001 6.67203 22.5001 7.50012V11.9999H26.9999C27.8294 12.0013 28.5005 12.6747 28.4995 13.5037C28.4991 13.8429 28.3833 14.1725 28.1718 14.4375L18.1216 26.9999H26.9999C27.8285 26.9999 28.5 27.6719 28.5 28.5C28.5 29.3286 27.8285 30.0001 26.9999 30.0001Z"
                                                    fill="#5B5D81" />
                                            </svg>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="card overflow-hidden">
                                        <div class="card-body d-flex align-items-center">
                                            <div class="me-4">
                                                <p class="mb-2 fs-13"><i class="fa fa-caret-up scale5 me-2 text-success"
                                                        aria-hidden="true"></i>4%(30 days)</p>
                                                <h4 class="heading mb-0">$65,123</h4>
                                            </div>
                                            <svg width="42" height="42" viewBox="0 0 42 42" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M21.5566 23.893C21.1991 24.0359 20.8009 24.0359 20.4434 23.893L16.6064 22.3582L21 31.1454L25.3936 22.3582L21.5566 23.893Z"
                                                    fill="#AC4CBC" />
                                                <path d="M21 20.8846L26.2771 18.7739L21 10.3304L15.7229 18.7739L21 20.8846Z"
                                                    fill="#AC4CBC" />
                                                <path
                                                    d="M21 0.00012207C9.40213 0.00012207 0.00012207 9.40213 0.00012207 21C0.00012207 32.5979 9.40213 41.9999 21 41.9999C32.5979 41.9999 41.9999 32.5979 41.9999 21C41.9871 9.40762 32.5924 0.0129395 21 0.00012207ZM29.8417 20.171L22.3417 35.171C21.9714 35.9121 21.0701 36.2124 20.3294 35.8421C20.0387 35.697 19.8034 35.4617 19.6583 35.171L12.1583 20.171C11.9253 19.7032 11.9519 19.1479 12.2284 18.7043L19.7284 6.70453C20.2269 6.00232 21.1996 5.83661 21.9018 6.33511C22.0451 6.43674 22.1701 6.56125 22.2717 6.70453L29.7712 18.7043C30.0482 19.1479 30.0747 19.7032 29.8417 20.171Z"
                                                    fill="#AC4CBC" />
                                            </svg>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="container mt-2">
                    <div class="row d-flex flex-column flex-md-row-reverse">
                        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-8">
                            <div class="card bubles hover-card shadow-lg border-0 pb-0"
                                style="box-shadow: 0 8px 15px rgba(0,0,0,0.15); overflow: hidden; border-radius: 20px;">
                                <div class="card-body">
                                    <div class="buy-coin bubles-down">
                                        <div>
                                            <h2>Grab Items Easy & Fast!</h2>
                                            <p>
                                                Permudah ambil barang dengan sistem yang cepat dan transparan. Klik untuk
                                                memulai!
                                            </p>
                                        </div>
                                        <div class="coin-img d-none d-md-block">
                                            <img src="{{ asset('') }}assets/images/coin.png" class="img-fluid"
                                                alt="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
                            <div class="swiper mySwiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="card card-wiget">
                                            <div class="card-body">
                                                <div class="card-wiget-info">
                                                    <h4 class="count-num">$2,478.90</h4>
                                                    <p>Total Balance</p>
                                                    <div>
                                                        <svg class="me-1" width="20" height="20"
                                                            viewBox="0 0 20 20" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M19.6997 12.4191C18.364 17.7763 12.9382 21.0365 7.58042 19.7006C2.22486 18.365 -1.03543 12.9388 0.300792 7.582C1.63577 2.22424 7.06166 -1.03636 12.4179 0.299241C17.7753 1.63487 21.0353 7.06169 19.6997 12.4191Z"
                                                                fill="#F7931A" />
                                                            <path
                                                                d="M6.71062 11.684C6.65625 11.8191 6.51844 12.0215 6.20781 11.9447C6.21877 11.9606 5.41033 11.7456 5.41033 11.7456L4.86566 13.0015L6.29343 13.3575C6.55906 13.424 6.81938 13.4937 7.07563 13.5594L6.62155 15.3825L7.71748 15.6559L8.16716 13.8522C8.46655 13.9334 8.75716 14.0084 9.04153 14.079L8.5934 15.8743L9.6906 16.1477L10.1446 14.3281C12.0156 14.6821 13.4224 14.5393 14.0146 12.8472C14.4918 11.4847 13.9909 10.6987 13.0065 10.1862C13.7234 10.0209 14.2633 9.54937 14.4074 8.57532C14.6065 7.24471 13.5933 6.5294 12.208 6.05221L12.6574 4.24971L11.5602 3.97627L11.1227 5.73126C10.8343 5.65938 10.538 5.59157 10.2437 5.52437L10.6843 3.75781L9.58775 3.48438L9.13807 5.28623C8.89931 5.23186 8.66496 5.17808 8.43745 5.12154L8.43869 5.1159L6.92557 4.7381L6.63368 5.90996C6.63368 5.90996 7.44775 6.09653 7.43056 6.10808C7.87494 6.21902 7.95524 6.51307 7.94182 6.74622L6.71062 11.684ZM11.9006 12.0906C11.5615 13.4531 9.26747 12.7165 8.52372 12.5318L9.12622 10.1166C9.86995 10.3022 12.2549 10.6697 11.9006 12.0906ZM12.2399 8.55564C11.9306 9.79501 10.0212 9.16533 9.40183 9.01096L9.94808 6.82033C10.5674 6.97471 12.5621 7.26283 12.2399 8.55564Z"
                                                                fill="white" />
                                                        </svg>
                                                        <span>0.11857418</span>
                                                    </div>
                                                </div>
                                                <div id="NewCustomers"></div>
                                            </div>
                                            <div class="back-icon">
                                                <svg width="64" height="127" viewBox="0 0 64 127" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g opacity="0.05">
                                                        <path
                                                            d="M70.1991 32.0409C63.3711 28.2675 56.1119 25.3926 48.9246 22.4098C44.7559 20.6849 40.7669 18.6724 37.2451 15.8694C30.3093 10.3351 31.639 1.3509 39.7607 -2.20684C42.0606 -3.21307 44.4684 -3.5365 46.9121 -3.68024C56.3275 -4.18336 65.2758 -2.4584 73.7928 1.63839C78.0333 3.68679 79.4349 3.03993 80.8723 -1.38029C82.3817 -6.05207 83.6395 -10.7957 85.041 -15.5034C85.9753 -18.6659 84.8254 -20.7502 81.8426 -22.0799C76.3802 -24.4876 70.7741 -26.2126 64.8805 -27.1469C57.19 -28.3329 57.19 -28.3688 57.1541 -36.0952C57.1181 -46.984 57.1181 -46.984 46.1934 -46.984C44.6122 -46.984 43.0309 -47.02 41.4497 -46.984C36.3467 -46.8403 35.4842 -45.9419 35.3405 -40.8029C35.2686 -38.503 35.3405 -36.203 35.3045 -33.8671C35.2686 -27.0391 35.2327 -27.1469 28.6922 -24.7751C12.88 -19.0252 3.1052 -8.24421 2.06304 9.00543C1.12868 24.2785 9.10664 34.5924 21.6486 42.1032C29.375 46.739 37.9279 49.4702 46.1215 53.0998C49.3199 54.5014 52.3745 56.1185 55.0338 58.3466C62.904 64.8512 61.4665 75.6681 52.1229 79.7649C47.1277 81.957 41.845 82.4961 36.4186 81.8133C28.0453 80.7711 20.0314 78.579 12.4847 74.6619C8.06447 72.3619 6.77075 72.9729 5.2614 77.7524C3.96768 81.8852 2.81771 86.0538 1.66773 90.2225C0.122451 95.8286 0.697435 97.1583 6.05201 99.7817C12.88 103.088 20.1752 104.777 27.6141 105.963C33.4358 106.897 33.6155 107.149 33.6874 113.186C33.7233 115.917 33.7233 118.684 33.7593 121.416C33.7952 124.866 35.4483 126.878 39.006 126.95C43.0309 127.022 47.0918 127.022 51.1167 126.914C54.4229 126.842 56.1119 125.045 56.1119 121.703C56.1119 117.966 56.2916 114.192 56.1478 110.455C55.9682 106.646 57.6213 104.705 61.2868 103.699C69.7319 101.399 76.9193 96.8708 82.4535 90.1147C97.8345 71.4276 91.9768 44.0797 70.1991 32.0409Z"
                                                            fill="#9568FF" />
                                                    </g>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="card card-wiget">
                                            <div class="card-body">
                                                <div class="card-wiget-info">
                                                    <h4 class="count-num">$3,27.23</h4>
                                                    <p>Profit & Loss</p>
                                                    <div>
                                                        <span class="text-success">+3.02%</span>
                                                    </div>
                                                </div>
                                                <div id="ProfitlossChart"></div>
                                            </div>
                                            <div class="back-icon">
                                                <svg width="157" height="114" viewBox="0 0 157 114" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g opacity="0.05">
                                                        <path
                                                            d="M12.1584 84.1906V110.157C12.1584 111.737 13.5953 113.053 15.4007 113.053H37.8751C39.6436 113.053 41.1173 111.77 41.1173 110.157V64.4771L24.7957 79.0565C21.3324 82.1172 16.9112 83.8944 12.1584 84.1906Z"
                                                            fill="#9568FF" />
                                                        <path
                                                            d="M52.3177 64.1484V110.158C52.3177 111.737 53.7546 113.054 55.56 113.054H78.0344C79.8029 113.054 81.2766 111.77 81.2766 110.158V83.0721C76.1554 82.9734 71.3657 81.1633 67.7551 77.938L52.3177 64.1484Z"
                                                            fill="#9568FF" />
                                                        <path
                                                            d="M92.4769 80.2078V110.157C92.4769 111.736 93.9138 113.053 95.7191 113.053H118.194C119.962 113.053 121.436 111.769 121.436 110.157V54.8994L95.6823 77.904C94.6875 78.7926 93.6191 79.5496 92.4769 80.2078Z"
                                                            fill="#9568FF" />
                                                        <path
                                                            d="M159.421 20.9355L132.636 44.8617V110.157C132.636 111.736 134.073 113.053 135.878 113.053H158.353C160.121 113.053 161.595 111.769 161.595 110.157V22.7456C160.858 22.1862 160.306 21.6925 159.9 21.3634L159.421 20.9355Z"
                                                            fill="#9568FF" />
                                                        <path
                                                            d="M177.806 -21.4532C176.737 -22.4734 175.116 -23 173.053 -23C172.869 -23 172.648 -23 172.464 -23C162 -22.5722 151.573 -22.1114 141.11 -21.6836C139.71 -21.6177 137.794 -21.5519 136.283 -20.2026C135.804 -19.7747 135.436 -19.2811 135.141 -18.6887C133.594 -15.6938 135.768 -13.7521 136.799 -12.8306L139.415 -10.461C141.22 -8.81546 143.063 -7.16992 144.905 -5.55729L81.6816 50.9505L53.2754 25.5763C51.5806 24.0624 49.2964 23.2067 46.8647 23.2067C44.433 23.2067 42.1856 24.0624 40.4908 25.5763L2.65272 59.3427C-0.88424 62.5022 -0.88424 67.6033 2.65272 70.7628L4.34751 72.2767C6.0423 73.7906 8.32659 74.6462 10.7582 74.6462C13.1899 74.6462 15.4374 73.7906 17.1321 72.2767L46.8647 45.7177L75.2709 71.0919C76.9657 72.6058 79.25 73.4615 81.6816 73.4615C84.1133 73.4615 86.3607 72.6058 88.0924 71.0919L159.421 7.37663L167.49 14.5512C168.448 15.4069 169.774 16.5916 171.8 16.5916C172.648 16.5916 173.495 16.3942 174.379 15.9663C174.969 15.6702 175.485 15.341 175.927 14.9461C177.511 13.5309 177.806 11.7209 177.88 10.3057C178.174 4.25011 178.506 -1.80547 178.837 -7.89396L179.316 -17.0102C179.427 -18.9191 178.948 -20.4001 177.806 -21.4532Z"
                                                            fill="#9568FF" />
                                                    </g>
                                                </svg>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="card card-wiget">
                                            <div class="card-body">
                                                <div class="card-wiget-info rewards">
                                                    <h4 class="count-num">$52,478.90</h4>
                                                    <p>Rewards Earned</p>
                                                    <div>
                                                        <span class="text-primary">+200 This Month</span>
                                                    </div>
                                                    <div class="d-flex align-items-baseline reward-earn">
                                                        <h2 class="me-2">25%</h2>
                                                        <span>Level 2</span>
                                                    </div>
                                                    <div class="progress-box">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-primary"
                                                                style="width:50%; height:7px; border-radius:4px;"
                                                                role="progressbar"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="back-icon">
                                                <svg width="115" height="123" viewBox="0 0 115 123" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g opacity="0.05">
                                                        <path
                                                            d="M15.3627 66.1299L0.487194 95.8762C-0.228022 97.3054 -0.151221 99.0034 0.687599 100.362C1.52882 101.719 3.00965 102.546 4.60689 102.546H26.9838L40.4097 120.447C41.2821 121.614 42.6514 122.29 44.0926 122.29C46.0066 122.29 47.5151 121.148 48.2159 119.744L62.2334 91.7073C43.2814 89.8952 26.5722 80.2854 15.3627 66.1299Z"
                                                            fill="#9568FF" />
                                                        <path
                                                            d="M137.06 95.8762L122.184 66.1299C110.975 80.2854 94.2658 89.8952 75.3137 91.7073L89.3324 119.744C90.0321 121.148 91.5405 122.29 93.4545 122.29C94.8958 122.29 96.2662 121.614 97.1386 120.447L110.563 102.546H132.94C134.537 102.546 136.018 101.719 136.86 100.362C137.698 99.0034 137.775 97.3054 137.06 95.8762Z"
                                                            fill="#9568FF" />
                                                        <path
                                                            d="M76.4862 10.3573L68.7736 -1.96338L61.0634 10.3573C60.431 11.3677 59.4314 12.0937 58.2758 12.383L44.1766 15.9098L53.5105 27.0509C54.2761 27.9641 54.6577 29.1389 54.5749 30.3282L53.5705 44.8269L67.0504 39.3932C67.6912 39.1352 69.0016 38.7908 70.4956 39.3932L83.9768 44.8269L82.9735 30.3282C82.8919 29.1389 83.2735 27.9641 84.0392 27.0509L93.373 15.9098L79.2738 12.383C78.1182 12.0937 77.1186 11.3677 76.4862 10.3573Z"
                                                            fill="#9568FF" />
                                                        <path
                                                            d="M127.676 23.9022C127.676 -8.57659 101.252 -35 68.7736 -35C36.2949 -35 9.87146 -8.57659 9.87146 23.9022C9.87146 56.3797 36.2949 82.8043 68.7736 82.8043C101.252 82.8043 127.676 56.3809 127.676 23.9022ZM105.166 16.1848L92.2966 31.5451L93.679 51.5352C93.7882 53.1192 93.0754 54.6481 91.7914 55.5817C90.5061 56.5141 88.8321 56.7205 87.3596 56.1277L68.7736 48.6359L50.1876 56.1277C49.6896 56.3281 47.7059 56.9977 45.7559 55.5817C44.4719 54.6481 43.759 53.1192 43.8682 51.5352L45.2531 31.5451L32.384 16.186C31.364 14.968 31.0424 13.3119 31.5332 11.8023C32.024 10.2926 33.2576 9.14062 34.7984 8.75541L54.2365 3.8929L64.8675 -13.0935C65.71 -14.4387 67.186 -15.2559 68.7736 -15.2559C70.3613 -15.2559 71.8373 -14.4387 72.6797 -13.0935L83.3132 3.8929L102.751 8.75541C104.292 9.14062 105.526 10.2926 106.016 11.8023C106.507 13.3119 106.186 14.968 105.166 16.1848Z"
                                                            fill="#9568FF" />
                                                    </g>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bagian khusus user -->
                <div class="container mt-2">
                    <div class="row d-flex flex-column flex-md-row-reverse">
                        <div class="col-xl-4 col-sm-6">
                            <div class="card bg-secondary email-susb hover-card"
                                style="box-shadow: 0 8px 15px rgba(0,0,0,0.15); border-radius: 20px;">
                                <div class="card-body text-center">
                                    <div style="width: 100%; max-width: 500px; overflow: hidden;">
                                        <img src="{{ asset('assets/images/metaverse.png') }}" alt=""
                                            style="width: 65%; height: auto; object-fit: cover;">
                                    </div>
                                    <div class="toatal-email mt-0">
                                        <h5>Butuh Perbaikan Kami Siap Melayani!</h5>
                                    </div>
                                    <a href="#" class="btn btn-primary email-btn p-2" data-bs-toggle="modal"
                                        data-bs-target="#tradeModal">Hubungi Kami</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-sm-6">
                            <div class="card" style="background: transparent; box-shadow: none; border: none;">
                                <div class="card-body pt-0">
                                    <h1 class="mb-4 mt-0" style="color: var(--secondary)">Completed Repairs</h1>

                                    <div class="horizontal-scroll-wrapper" id="scrollContainer">
                                        @php
                                            $completedRepairs = $userRepairs->where('status', 'completed');
                                        @endphp

                                        @forelse ($completedRepairs as $repair)
                                            <div class="card-item">
                                                <div class="card shadow-sm card-content"
                                                    style="min-height: 180px; border-radius: 12px; overflow: hidden; background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); border: none;">
                                                    <div class="card-body d-flex align-items-center"
                                                        style="padding: 2px;">
                                                        <div class="me-3">
                                                            <img src="{{ optional($repair->admin)->profile ? asset($repair->admin->profile) : asset('assets/images/no-profile.jpg') }}"
                                                                alt="Admin Profile" width="50" height="50"
                                                                style="border-radius: 50%; object-fit: cover; border: 2px solid #ddd;">
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-1" style="font-weight: 400;">
                                                                {{ $repair->admin->name ?? 'Admin Tidak Diketahui' }}</h6>
                                                            <small><i class="fas fa-calendar-alt me-1"></i>
                                                                {{ $repair->scheduled_date ? \Carbon\Carbon::parse($repair->scheduled_date)->translatedFormat('d F Y') : 'Belum Dijadwalkan' }}
                                                            </small>
                                                            <span class="badge mt-2"
                                                                style="background-color: var(--primary); color: white; margin-left:4px;">Completed</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @empty
                                            <p class="text-muted">Belum ada repair yang selesai.</p>
                                        @endforelse
                                    </div>

                                    <div class="dot-indicators">
                                        <span class="dot active"></span>
                                        <span class="dot"></span>
                                        <span class="dot"></span>
                                        <span class="dot"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <style>
                            .horizontal-scroll-wrapper {
                                overflow-x: auto;
                                white-space: nowrap;
                                scrollbar-width: none;
                                -ms-overflow-style: none;
                                scroll-behavior: smooth;
                                padding-bottom: 10px;
                            }

                            .horizontal-scroll-wrapper::-webkit-scrollbar {
                                display: none;
                            }

                            .card-item {
                                display: inline-block;
                                width: 250px;
                                margin-right: 10px;
                            }

                            .card-content {
                                background: rgba(255, 255, 255, 0.8);
                                backdrop-filter: blur(10px);
                                border-radius: 12px;
                                overflow: hidden;
                                border: none;
                            }

                            .dot-indicators {
                                display: flex;
                                justify-content: center;
                                margin-top: 10px;
                            }

                            .dot {
                                width: 10px;
                                height: 10px;
                                margin: 0 5px;
                                border-radius: 50%;
                                background-color: #ccc;
                                transition: background-color 0.3s;
                            }

                            .dot.active {
                                background-color: var(--primary);
                            }
                        </style>

                        <script>
                            const container = document.getElementById('scrollContainer');
                            const dots = document.querySelectorAll('.dot');

                            container.addEventListener('scroll', () => {
                                const scrollLeft = container.scrollLeft;
                                const totalWidth = container.scrollWidth - container.clientWidth;

                                const activeIndex = Math.round((scrollLeft / totalWidth) * (dots.length - 1));

                                dots.forEach((dot, index) => {
                                    dot.classList.toggle('active', index === activeIndex);
                                });
                            });
                        </script>


                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 10,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
@endsection
