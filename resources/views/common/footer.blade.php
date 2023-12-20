<footer>
</footer>
@if(session('success'))
<div class="alert-container">
    <div class="alert alert-success">
        <div class="notification">
            <span>{{ session('success') }}</span><strong>X</strong>
        </div>
        <div class="progressbar"></div>
    </div>
</div>
@endif
@if($errors->any())
<div class="alert-container">
    @foreach($errors->all() as $error)
        <div class="alert alert-error">
            <div class="notification">
                <span>{{ $error }}</span><strong>X</strong>
            </div>
            <div class="progressbar"></div>
        </div>
    @endforeach
</div>
@endif
<script>
document.addEventListener('DOMContentLoaded', function () {
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