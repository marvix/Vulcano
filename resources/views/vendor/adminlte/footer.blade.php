<!-- Rodapé da página -->
<div class="row">
    <footer class="main-footer footer">
        <div class="pull-left hidden-xs" style="margin-left:10px">
            @if(\Session::get('footer_left'))
            {!! \Session::get('footer_left') !!}
            @else
            {!! env('FOOTER_LEFT') !!}
            @endif
        </div>
        <div class="pull-right hidden-xs" style="margin-right:10px">
            @if(\Session::get('footer_right'))
            {!! \Session::get('footer_right') !!}
            @else
            {!! env('FOOTER_RIGHT') !!}
            @endif
        </div>
    </footer>
</div>
