<main>
        <img id="mapa" src="<?php echo IMG.'mapa.jpg';?>">
    </main>
    <script>
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const scriptToLoad = getQueryParam('script');
            const script = document.createElement('script');
            if(scriptToLoad === '03cargarCoord.js'){
                script.src = "<?php echo JS.'03cargarCoord.js';?>";
            }
            else{
                script.src = "<?php echo JS.'01coordCop.js';?>";
            }
            script.defer = true; // Asegura que el script se ejecute después de que el documento esté completamente cargado
            document.body.appendChild(script);
        });
    </script>
</body>
</html>