<!-- Flexbox container for aligning the toasts -->
<div aria-live="polite" aria-atomic="true" class="toaster d-flex justify-content-center align-items-center acceptCookiePopup" style="display:none !important ;">
    <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <!-- <button type="button" class="ml-2 mb-1 close closeCookie" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> -->
        <div class="toast-body">
            <div class="row">
                <div class="col-md-10">
                    <h3>Käytämme evästeitä</h3>
                    <p>Flipkoti Oy kerää evästeiden, Googlen sekä Facebookin työkalujen avulla tietoa sivuston käytöstä, jotta palvelun käyttökokemusta voidaan jatkuvasti kehittää paremmaksi. Hyväksymällä sallit tietojen käsittelyn. <br/>
                    <a href="{{ route('frontend.tietosuojaseloste') }}" >Tietosuojaseloste</a> | <a href="{{ route('frontend.terms') }}" >Käyttöehdot</a> </p>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-dark acceptCookie">Hyväksy</button>
                    <!-- <button class="btn btn-light closeCookie">Close</button> -->
                </div>
            </div>
        </div>
    </div>
</div>

    @push('after-scripts')
<script>
 $(document).ready(function() {

    $(".closeCookie").click(function(){ 
        $('.acceptCookiePopup').attr('style','display:none !important;');
    });
    $(".acceptCookie").click(function(){ 
        localStorage.setItem("acceptCookie", "done");
        $('.acceptCookiePopup').attr('style','display:none !important;');
    });

    if(localStorage.getItem("acceptCookie")){
        $('.acceptCookiePopup').attr('style','display:none !important;');
    }else{
        $('.acceptCookiePopup').removeAttr('style');
    }
      
});
</script>
@endpush