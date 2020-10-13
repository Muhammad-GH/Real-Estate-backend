{{ html()->form('POST', route('frontend.marketplace.storeWorkBid', $work->id))->attribute('novalidate', true)->id('work-bid-form')->open() }}

    <div class="form-group">
        <div class="row align-items-center">
            <div class="col-5">
                <label class="d-flex ">Sinun tarjous</label>
            </div>
            <div class="col-7">
                <label class="d-flex align-items-center">
                    €@php 
                        echo ( ($work->budget!='Fixed') ? budgetTypeFormat($work->budget) : ''  );
                    @endphp
                    <input class="form-control" type="text" name="quote" required/>
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>Nimi</label>
        <input class="form-control" type="text" name="name" required />
    </div>
    <div class="form-group">
        <label>Sähköpostiosoite</label>
        <input class="form-control" type="text" name="email_address" required />
    </div>
    <div class="form-group">
        <label>Puhelinnumero</label>
        <input class="form-control" type="text" name="contact_number" required />
    </div>
    <div class="form-group">
        <label>Viesti:</label>
        <textarea class="form-control" name="message" required></textarea>
    </div>
    <div class="form-group">
        <div class="checkbox">
        <label class="light" for="terms"><input type="checkbox" class="custom-check" id="terms" name="terms" required><span class="checkmark"></span>Olen lukenut Flipkodin <a href="{{ route('frontend.tietosuojaseloste') }}" class="custom-link">tietosuojaselosteen</a> ja <a href="{{ route('frontend.terms') }}" class="custom-link">käyttöehdot</a></label>
        </div>
        <!-- <label><input type="checkbox" name="terms" required /> <span class="check-text">Olen lukenut Flipkodin <a href="{{ route('frontend.tietosuojaseloste') }}" class="custom-link"> tietosuojaselosteen</a> ja <a href="{{ route('frontend.terms') }}" class="custom-link"> käyttöehdot</a></span></label> -->
    </div>
    <button type="submit">{{ __('Submit your bid') }}</button>

{{ html()->form()->close() }}

@push('after-styles')
<style>
    /*input.custom-check {position: absolute;}*/
    form label.error {color: red;}
</style>
@endpush