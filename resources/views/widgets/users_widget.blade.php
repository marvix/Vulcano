<div class="col-sm-4">
    <div class="small-box {{ $config['color'] }}">
        <div class="inner">
            <h3>{{ $quantidade }}</h3>
            <p>{{ $config['title'] }}</p>
        </div>
        <div class="icon">
            <i class="{{ $config['icon'] }}"></i>
        </div>
        <a href="{{ route($config['route']) }}" class="small-box-footer">
            Mais Informações
            <i class="fa fa-arrow-circle-right"></i>
        </a>
    </div>
</div>
