<header>
    <div class="container">
        <a href="{{ route('landing') }}" class="logo"><img src="http://localhost:8000/img/logo.svg" alt="BackEvent" title="Pagina Principal - Back Event"style="width:auto;height:50px;"></a>
        <nav class="right">
            <a href="{{ route('listado-actos.get') }}">
                <i class="icon">
                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M8 6.00067L21 6.00139M8 12.0007L21 12.0015M8 18.0007L21 18.0015M3.5 6H3.51M3.5 12H3.51M3.5 18H3.51M4 6C4 6.27614 3.77614 6.5 3.5 6.5C3.22386 6.5 3 6.27614 3 6C3 5.72386 3.22386 5.5 3.5 5.5C3.77614 5.5 4 5.72386 4 6ZM4 12C4 12.2761 3.77614 12.5 3.5 12.5C3.22386 12.5 3 12.2761 3 12C3 11.7239 3.22386 11.5 3.5 11.5C3.77614 11.5 4 11.7239 4 12ZM4 18C4 18.2761 3.77614 18.5 3.5 18.5C3.22386 18.5 3 18.2761 3 18C3 17.7239 3.22386 17.5 3.5 17.5C3.77614 17.5 4 17.7239 4 18Z" stroke="#1d487b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                </i>
                <span>Listado de actos</span>
            </a>
        @if ($userInfo !== null)
            @if($userInfo->id_tipo_usuario == 3)
            <a href="{{ route('panel-administracion') }}">
                <i class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 17">
                        <path d="M0 0v17h17V0H0zm16 16H1V1h15v15zM4 10.232V13h1v-2.768c.738-.218 1.281-.894 1.281-1.701S5.738 7.048 5 6.83V4H4v2.83c-.738.218-1.281.894-1.281 1.701S3.262 10.015 4 10.232zm.5-2.482a.782.782 0 0 1 0 1.562.781.781 0 0 1 0-1.562zm3.5.357V13h1V8.107c.738-.218 1.281-.894 1.281-1.701S9.738 4.923 9 4.705V4H8v.705c-.738.218-1.281.894-1.281 1.701S7.262 7.89 8 8.107zm.5-2.482a.782.782 0 1 1-.002 1.564.782.782 0 0 1 .002-1.564zm4 7.792c.982 0 1.781-.799 1.781-1.781 0-.808-.543-1.483-1.281-1.701V4h-1v5.935a1.778 1.778 0 0 0-1.281 1.701c0 .982.799 1.781 1.781 1.781zm0-2.563a.782.782 0 0 1 0 1.562.782.782 0 0 1 0-1.562z"/>
                    </svg>
                </i>
                <span>Panel de administrador</span>
            </a>
            @endif
            @if(request()->routeIs('panel-personal'))
            <a href="{{ route('editar-perfil') }}">
                <i class="icon">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M 4.7923934,23.56111 C 2.8327745,23.313559 1.182342,21.954113 0.55503522,20.070837 0.29882832,19.301662 0.30988007,19.57656 0.29190261,13.52544 0.27431461,7.6050162 0.28635872,7.119317 0.46735161,6.4225258 0.77981378,5.2199249 1.542522,4.1438618 2.5648659,3.4632606 3.2875845,2.9821268 4.0347863,2.7113876 4.9089436,2.6139134 c 0.5378058,-0.059968 5.8953534,-0.060419 6.1110724,-5.155e-4 0.185394,0.051485 0.423322,0.2491392 0.516272,0.4288857 0.165452,0.3199478 0.02833,0.8050615 -0.286452,1.0134449 L 11.07704,4.1701184 7.9555059,4.1919294 4.8339726,4.2137405 4.4597605,4.3295109 C 3.228549,4.7104096 2.3450907,5.623896 2.0166857,6.8556245 l -0.093262,0.3497767 v 5.8834568 5.883458 l 0.093137,0.353423 c 0.3676586,1.395204 1.5058449,2.419039 2.9120069,2.619441 0.225659,0.03217 2.2010479,0.04207 6.6412364,0.0333 l 6.320039,-0.01247 0.279907,-0.108909 c 0.668596,-0.260145 1.107435,-0.833406 1.339296,-1.749534 0.175855,-0.694838 0.189206,-0.986009 0.190288,-4.149753 9.72e-4,-2.845328 0.0054,-3.023825 0.07803,-3.180809 0.145646,-0.314583 0.396051,-0.478161 0.731966,-0.478161 0.335914,0 0.586318,0.163578 0.731965,0.478161 0.07265,0.156933 0.07705,0.334061 0.07778,3.13923 4.54e-4,1.750249 -0.01717,3.169566 -0.04285,3.451074 -0.112264,1.230424 -0.49828,2.271308 -1.10623,2.98292 -0.552093,0.646233 -1.436413,1.099929 -2.363301,1.212484 -0.458993,0.05573 -12.5721979,0.05423 -13.0142909,-0.0017 z m 2.621454,-5.404216 C 6.5507525,18.031125 6.0125239,17.561898 5.8337691,16.779384 5.6503657,15.976519 5.7451513,14.774733 6.0844501,13.601026 6.2025406,13.192524 6.4809901,12.576327 6.685623,12.270655 6.8668813,11.999898 17.614982,1.2393245 17.935111,1.0081113 c 0.74775,-0.54006036 1.748615,-0.77910848 2.623907,-0.6266977 0.796246,0.13864655 1.454622,0.47116722 1.987025,1.0035703 1.191338,1.1913382 1.393231,2.9979833 0.498192,4.4580844 -0.171419,0.2796396 -0.908077,1.0342799 -5.503536,5.6378707 -2.918095,2.92326 -5.451424,5.43262 -5.62962,5.576358 -0.694674,0.560343 -1.768526,0.941878 -3.1052019,1.103264 -0.4101418,0.04952 -1.038389,0.04786 -1.3920297,-0.0036 z m 1.8067312,-1.695289 c 0.4567828,-0.105139 1.0257454,-0.306854 1.3929034,-0.493819 0.269993,-0.137489 0.671238,-0.527576 5.544967,-5.39083 2.889652,-2.8834399 5.3349,-5.3506764 5.433886,-5.4827472 0.290519,-0.3876261 0.3682,-0.6352165 0.3682,-1.1735641 0,-0.5452996 -0.08058,-0.79589 -0.384681,-1.1963023 C 20.998082,1.9635843 19.987253,1.7395573 19.106672,2.1771052 18.928513,2.2656301 17.886509,3.2859706 13.511263,7.6561891 9.1352647,12.027158 8.1088974,13.072913 7.9956764,13.275965 7.54273,14.088284 7.2429062,15.561345 7.3885519,16.258824 c 0.044818,0.214629 0.063135,0.242778 0.1821081,0.279857 0.2081031,0.06486 1.2434199,0.01649 1.6499186,-0.07708 z"/>
                    </svg>
                </i>
                <span>Editar Perfil</span>
            </a>
            @else
            <a href="{{ route('panel-personal') }}">
                <i class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.563 18H3.438c-.706 0-1.228-.697-.961-1.338C3.713 13.698 6.617 12 10 12c3.384 0 6.288 1.698 7.524 4.662.267.641-.255 1.338-.961 1.338M5.917 6c0-2.206 1.832-4 4.083-4 2.252 0 4.083 1.794 4.083 4S12.252 10 10 10c-2.251 0-4.083-1.794-4.083-4m14.039 11.636c-.742-3.359-3.064-5.838-6.119-6.963 1.619-1.277 2.563-3.342 2.216-5.603-.402-2.623-2.63-4.722-5.318-5.028C7.023-.381 3.875 2.449 3.875 6c0 1.89.894 3.574 2.289 4.673-3.057 1.125-5.377 3.604-6.12 6.963C-.226 18.857.779 20 2.054 20h15.892c1.276 0 2.28-1.143 2.01-2.364"/>
                    </svg>
                </i>
                <span>Mi Perfil</span>
            </a>
            @endif 
            <a href="{{ route('cerrar-sesion') }}">
                <i class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M2 6.5A4.5 4.5 0 0 1 6.5 2H12a4 4 0 0 1 4 4v1a1 1 0 1 1-2 0V6a2 2 0 0 0-2-2H6.5A2.5 2.5 0 0 0 4 6.5v11A2.5 2.5 0 0 0 6.5 20H12a2 2 0 0 0 2-2v-1a1 1 0 1 1 2 0v1a4 4 0 0 1-4 4H6.5A4.5 4.5 0 0 1 2 17.5v-11Zm16.293 1.793a1 1 0 0 1 1.414 0l3 3a1 1 0 0 1 0 1.414l-3 3a1 1 0 0 1-1.414-1.414L19.586 13H11a1 1 0 1 1 0-2h8.586l-1.293-1.293a1 1 0 0 1 0-1.414Z" clip-rule="evenodd"/>
                    </svg>
                </i>
                <span>Salir</span>
            </a>
        @else
            <a href="{{ route('iniciar-sesion') }}">
                <i class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M13 2a5 5 0 0 0-5 5 1 1 0 0 0 2 0 3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-4a3 3 0 0 1-3-3 1 1 0 1 0-2 0 5 5 0 0 0 5 5h4a5 5 0 0 0 5-5V7a5 5 0 0 0-5-5h-4Z"/>
                        <path d="M3 11a1 1 0 1 0 0 2h8.282a39.319 39.319 0 0 0-1.027 1.325l-.047.063-.012.018-.005.005L11 15l-.809-.588a1 1 0 0 0 1.618 1.176l.003-.004.01-.014.042-.057.16-.216c.14-.184.337-.442.57-.736.472-.595 1.068-1.31 1.613-1.854l.707-.707-.707-.707c-.545-.545-1.142-1.26-1.613-1.854a38.245 38.245 0 0 1-.73-.952l-.042-.057-.01-.014-.002-.003a1 1 0 0 0-1.619 1.175L11 9l-.809.588.002.002.003.005.012.017.047.063.172.23A40.079 40.079 0 0 0 11.282 11H3Z"/>
                    </svg>
                </i>
                <span>Iniciar sesión</span>
            </a>
            <a href="{{ route('registrarse') }}">
                <i class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22">
                        <path fill-rule="evenodd" d="M14.083 6c0-2.206-1.831-4-4.083-4-2.252 0-4.083 1.794-4.083 4S7.748 10 10 10c2.252 0 4.083-1.794 4.083-4m3.863 14h-1.821a1.01 1.01 0 0 1-1.021-1c0-.552.457-1 1.02-1h.439c.706 0 1.228-.697.96-1.338C16.287 13.698 13.383 12 10 12c-3.384 0-6.287 1.698-7.523 4.662-.268.641.254 1.338.96 1.338h.438c.564 0 1.021.448 1.021 1s-.457 1-1.02 1H2.053c-1.276 0-2.28-1.143-2.01-2.364.743-3.359 3.064-5.838 6.12-6.963C4.77 9.574 3.875 7.89 3.875 6c0-3.551 3.148-6.381 6.859-5.958 2.689.306 4.916 2.405 5.32 5.028.346 2.261-.598 4.326-2.218 5.603 3.056 1.125 5.377 3.604 6.12 6.963.27 1.221-.734 2.364-2.01 2.364m-4.884-1c0 .552-.457 1-1.02 1h-.813c0 1 .106 2-1.02 2a1.01 1.01 0 0 1-1.022-1v-1H7.958a1.01 1.01 0 0 1-1.02-1c0-.552.457-1 1.02-1h1.23v-1c0-.552.456-1 1.02-1 .564 0 1.021.448 1.021 1v1h.813c.563 0 1.02.448 1.02 1"/>
                    </svg>
                </i>
                <span>Regístrate</span>
            </a>
        @endif        
        </nav>
    </div>
</header>