  <script src="www/style/bib/assets/jquery/jquery-3.3.1.min.js"></script>
  <script src="www/style/bib/assets/jquery/jquery-migrate-3.0.0.min.js"></script>
  <script src="assets/library/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="www/style/bib/assets/library/bootstrap-4.3.1-dist/addons/masonry.pkgd.min.js"></script>
  <script src="www/style/bib/assets/library/bootstrap-4.3.1-dist/addons/imagesloaded.pkgd.min.js"></script>
  <script src="www/style/bib/assets/library/OwlCarousel2-2.3.4/owl.carousel.min.js"></script>
  <script>

    $('#container--carousel').owlCarousel({
      loop    : true,
      margin  : 20,
      nav     : true,
      navText : ['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>'],
      items   : 4,
      dots    : false,
      responsive : {
        0:{
          items:1
        },
        576:{
          items:2
        },
        768:{
          items:3
        },
        992:{
          items:4
        }
      }
    })
    $(document).ready(function () {
      $('.navbar .dropdown-item').on('click', function (e) {
        var $el = $(this).children('.dropdown-toggle');
        var $parent = $el.offsetParent(".dropdown-menu");
        $(this).parent("li").toggleClass('open');

        if (!$parent.parent().hasClass('navbar-nav')) {
          if ($parent.hasClass('show')) {
            $parent.removeClass('show');
            $el.next().removeClass('show');
            $el.next().css({"top": -999, "left": -999});
          } else {
            $parent.parent().find('.show').removeClass('show');
            $parent.addClass('show');
            $el.next().addClass('show');
            $el.next().css({"top": $el[0].offsetTop, "left": $parent.outerWidth() - 4});
          }
          e.preventDefault();
          e.stopPropagation();
        }
      });

      $('.navbar .dropdown').on('hidden.bs.dropdown', function () {
        $(this).find('li.dropdown').removeClass('show open');
        $(this).find('ul.dropdown-menu').removeClass('show open');
      });
    });
  </script> 
<!-- INCLUDE BLOCK : www/templates/general/base_buscador.tpl -->
