<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />

<div id="header-carousel" class="slick-slider w-full">
    <div><img src="https://via.placeholder.com/1200x500?text=Image+1" class="w-full h-auto" /></div>
    <div><img src="https://via.placeholder.com/1200x500?text=Image+2" class="w-full h-auto" /></div>
    <div><img src="https://via.placeholder.com/1200x500?text=Image+3" class="w-full h-auto" /></div>
    <!-- Add more images as needed -->
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

<script>
    $(document).ready(function() {
        $('#header-carousel').slick({
            autoplay: true,
            autoplaySpeed: 5000,
            arrows: true,
            dots: true,
            fade: true,
            pauseOnHover: false
        });
    });
</script>
