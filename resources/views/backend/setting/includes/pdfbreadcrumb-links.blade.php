<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Form PDF
            </a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.setting.pdf.index') }}">
                    All Form PDF
                </a>
                <a class="dropdown-item" href="{{ route('admin.setting.pdf.create') }}">
                    Create Form PDF
                </a>
                <a class="dropdown-item" href="{{ route('admin.setting.pdf.deleted') }}">
                    Deleted Form PDF
                </a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
