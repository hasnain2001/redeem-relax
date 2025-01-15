
     function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

        let navbar = document.getElementById('navbar');
        var scrollPrev = window.pageYOffset;
        window.onscroll = function () {
            var scrollCur = window.pageYOffset;
            if (scrollPrev > scrollCur) {
                navbar.style.top = "0";
            } else {
                navbar.style.top = "-90px";
            }
            scrollPrev = scrollCur;
        };

      



    // Add event listener for the select dropdown
    document.getElementById('languageSelector').addEventListener('change', function () {
        var selectedLang = this.value;
        var url = `/${selectedLang}`;
        
        // Check if the selected language is "EN" to redirect to the homepage
        if (selectedLang === 'en') {
            url = '/';  // Redirect to the homepage for English
        }

        window.location.href = url;  // Redirect the user to the new URL
    });
    // Scroll-to-top button logic
    let mybutton = document.getElementById("myBtn");
    window.onscroll = function() {scrollFunction()};
    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }



    
   
 

