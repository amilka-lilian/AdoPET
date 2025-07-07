<?php
// AdoPET/templates/footer.php

?>


    </main>
    <footer>
        <link rel="stylesheet" href="home.css">
        <p>&copy; <?php echo date("Y"); ?> ≽^•⩊•^≼ © 2025 <b>adoPET</b>. Todos os direitos reservados. ૮₍ • ᴥ • ₎ა</p>
    </footer>

    <script>
        window.addEventListener('scroll', function() {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>