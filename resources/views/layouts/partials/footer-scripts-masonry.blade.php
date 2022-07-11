<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
<script>


/* masonry instantiation */
            window.onload = function() {
                var myelem = document.querySelector("#for-masonry");
                console.log(myelem);
                var msnry = new Masonry(myelem, {
                    // options
                    percentPosition: true
                });
            };


</script>	


