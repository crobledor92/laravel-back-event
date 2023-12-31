<footer>
</footer>
<div class="alert-container">
    @if(session('success'))
    <div class="alert alert-success">
        <div class="notification">
            <span>{{session('success')}}  </span><strong>X</strong>
        </div>
        <div class="progressbar"></div>
    </div>
    @endif
    @if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-error">
            <div class="notification">
                <span>{{ $error }}</span><strong>X</strong>
            </div>
            <div class="progressbar"></div>
        </div>
    @endforeach
    @endif
</div>

<script>
function positionScroll() {
    localStorage.setItem('scrollpos', window.scrollY || window.pageYOffset);
}
document.addEventListener("DOMContentLoaded", function() {
    //Para obtener el scroll anterior.
    var scrollPos = localStorage.getItem('scrollpos');
    if (scrollPos !== null) {
        window.scrollTo(0, parseInt(scrollPos, 10));
        localStorage.removeItem('scrollpos');
    }
    //Para obtener mensajes almacenados.
    var mensajeExito = localStorage.getItem('mensaje_exito');
    if (mensajeExito) {
        var alertContainer = document.querySelector('.alert-container');
        var alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-success';
        var notificationDiv = document.createElement('div');
        notificationDiv.className = 'notification';
        var mensajeSpan = document.createElement('span');
        mensajeSpan.innerText = mensajeExito;
        var strongTag = document.createElement('strong');
        strongTag.innerText = 'X';
        notificationDiv.appendChild(mensajeSpan);
        notificationDiv.appendChild(strongTag);
        alertDiv.appendChild(notificationDiv);
        var progressbarDiv = document.createElement('div');
        progressbarDiv.className = 'progressbar';
        alertDiv.appendChild(progressbarDiv);
        alertContainer.appendChild(alertDiv);
        localStorage.removeItem('mensaje_exito');
    }
    var mensajeError = localStorage.getItem('mensaje_error');
    if (mensajeError) {
        var alertContainer = document.querySelector('.alert-container');
        var alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-error';
        var notificationDiv = document.createElement('div');
        notificationDiv.className = 'notification';
        var mensajeSpan = document.createElement('span');
        mensajeSpan.innerText = mensajeError;
        var strongTag = document.createElement('strong');
        strongTag.innerText = 'X';
        notificationDiv.appendChild(mensajeSpan);
        notificationDiv.appendChild(strongTag);
        alertDiv.appendChild(notificationDiv);
        var progressbarDiv = document.createElement('div');
        progressbarDiv.className = 'progressbar';
        alertDiv.appendChild(progressbarDiv);
        alertContainer.appendChild(alertDiv);
        localStorage.removeItem('mensaje_error');
    }
    //Para obtener los elementos de tipo mensaje y permitir cerrarlos al hacer clic.
    var targets = document.querySelectorAll('.alert');
    targets.forEach(function (target) {
        target.addEventListener('click', function () {
            fadeOut(target);
        });
    });
    function fadeOut(element) {
        var opacity = 1;
        var fadeOutInterval = setInterval(function () {
            if (opacity > 0) {
                opacity -= 0.1;
                element.style.opacity = opacity;
            } else {
                clearInterval(fadeOutInterval);
                element.style.display = 'none';
            }
        }, 10);
    }
});
</script>
</body>
</html>