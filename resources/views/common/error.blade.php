@if (count($errors) > 0)
    <div class="alert alert-error">
        <h4>有错误发生：</h4>
        <ul>
            @foreach ($errors->all() as $error)
                <li><i class=""></i> {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif