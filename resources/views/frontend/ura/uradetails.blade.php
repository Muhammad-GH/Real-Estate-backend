@extends('frontend.layouts.app')

@section('title','Asuntokaupan alusta')

@section('content')
    <div class="container padding-100">
        <div class="career-details">
            <div class="row">
                @include('includes.partials.messages')
                <div class="col-md-7">
                    <h2><?= $job->title ?></h2>
                    <span class="subtitle"><?=  $job->department_name ?></span>
                </div>
                <div class="col-md-5 text-right">
                    <span class="name"><?=  $job->location ?></span>
                </div>
            </div>
            <?= $job->description ?>
            <div class="apply-form">
                <h2>Hae nyt</h2>
                {{ html()->form('POST', route('frontend.submitcareer'))->id('career-form')->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->open() }}
                    <input type="hidden" name="title" value="<?= $job->title ?>">
                    <input type="hidden" name="department" value="<?= $job->department_name ?>">
                    <input type="hidden" name="location" value="<?= $job->location ?>">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Nimi" required name="name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Puhelinnumero" required name="phone">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input class="form-control" type="email" placeholder="Sähköposti" required name="email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Kerro meille itsestäsi ja saavutuksistasi" name="message"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="file-select">
                                <input type="file" name="file" id="file">
                                <label for="file">
                                    <i class="icon-attachment"></i>
                                    <span class="filename">Liitä portfolio / CV</span>
                                    <span class="clear">+</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-bordered" type="submit">Lähetä hakemus</button>
                            </div>
                        </div>
                    </div>
                {{ html()->form()->close() }}
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
<script>
    $(document).ready(function () {
        $('#career-form').validate({ // initialize the plugin
            rules: {
                name: {required: true},
                email: {required: true, email: true},
                phone: {required: true, minlength: 10/*, laxphone: true*/},
            },
            messages: {
                name: {required: 'Pakollinen tieto'},
                email: {required: 'Pakollinen tieto', email: 'Ole hyvä ja syötä toimiva Sähköposti!'},
                phone: {required: 'Pakollinen tieto', minlength: 'Puhelinnumero, että numerosi on oikein!'},
            }
        });
});
</script>
@endpush