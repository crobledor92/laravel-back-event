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
    <footer>
        
    </footer>
</body>
</html>