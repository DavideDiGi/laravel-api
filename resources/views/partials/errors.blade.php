@if ($errors->any())

        <div class="row">
            <div class="col">
                <div class="alert alert-danger pb-0 pt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>    
        </div>  

@endif