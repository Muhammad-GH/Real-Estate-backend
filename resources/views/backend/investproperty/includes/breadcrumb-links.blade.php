<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Invest Property
            </a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.investproperty.index') }}">
                    All Invest Properties
                </a>
                <a class="dropdown-item" href="{{ route('admin.investproperty.create') }}">
                    Create Invest Property
                </a>
                <a class="dropdown-item" href="{{ route('admin.investproperty.deleted') }}">
                    Deleted Invest Properties
                </a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
