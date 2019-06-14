<!-- skin -->
<div class="form-group">
    <div class="input-group col-sm-6">
        <label for="level">Cor da Interface (Barra Superior/Menu Lateral)
            <span class="text-red">*</span>
        </label>

        <select class="form-control {{ $errors->has('skin') ? 'is-invalid' : '' }}" id="skin" name="skin" required>
            <option value="blue" selected>Azul/Cinza Escuro</option>
            <option value="black">Branco/Cinza Escuro</option>
            <option value="purple">Roxo/Cinza Escuro</option>
            <option value="yellow">Laranja/Cinza Escuro</option>
            <option value="red">Vermelho/Cinza Escuro</option>
            <option value="green">Verde/Cinza Escuro</option>
            <option value="blue-light">Azul/Branco</option>
            <option value="black-light">Branco/Branco</option>
            <option value="purple-light">Roxo/Branco</option>
            <option value="yellow-light">Laranja/Branco</option>
            <option value="red-light">Vermelho/Branco</option>
            <option value="green-light">Verde/Branco</option>
        </select>

        @if($errors->has('skin'))
        <span class='invalid-feedback text-red'>
            {{ $errors->first('skin') }}
        </span>
        @endif
    </div>
</div>
