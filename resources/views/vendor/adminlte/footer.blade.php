<!-- Rodapé da página -->
<div class="row">
    <footer class="main-footer footer">
        <div class="pull-left hidden-xs" style="margin-left:10px">
            @if(\Session::has('footer_left'))
            {!! \Session::get('footer_left') !!}
            @else
            Copyright &copy; 2019. Todos os direitos reservados.
            @endif
        </div>
        <div class="pull-right hidden-xs" style="margin-right:10px">
            @if(\Session::has('footer_right'))
            {!! \Session::get('footer_right') !!}
            @else
            Desenvolvido por: <strong> Fernando Salles Claro</strong>
            @endif
        </div>
    </footer>
</div>
