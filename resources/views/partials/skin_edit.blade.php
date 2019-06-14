<!-- skin -->
<div class="form-group">
    <div class="input-group col-sm-6">
        <label for="level">Cor da Interface (Barra Superior/Menu Lateral)
            <span class="text-red">*</span>
        </label>

        <select class="form-control {{ $errors->has('skin') ? 'is-invalid' : '' }}" id="skin" name="skin" required>
            <option value="blue" {{ $user->skin == "blue" ? "selected" : "" }}>Azul/Cinza Escuro</option>
            <option value="black" {{ $user->skin == "black" ? "selected" : "" }}>Branco/Cinza Escuro</option>
            <option value="purple" {{ $user->skin == "purple" ? "selected" : "" }}>Roxo/Cinza Escuro</option>
            <option value="yellow" {{ $user->skin == "yellow" ? "selected" : "" }}>Laranja/Cinza Escuro</option>
            <option value="red" {{ $user->skin == "red" ? "selected" : "" }}>Vermelho/Cinza Escuro</option>
            <option value="green" {{ $user->skin == "green" ? "selected" : "" }}>Verde/Cinza Escuro</option>
            <option value="blue-light" {{ $user->skin == "blue-light" ? "selected" : "" }}>Azul/Branco</option>
            <option value="black-light" {{ $user->skin == "black-light" ? "selected" : "" }}>Branco/Branco</option>
            <option value="purple-light" {{ $user->skin == "purple-light" ? "selected" : "" }}>Roxo/Branco</option>
            <option value="yellow-light" {{ $user->skin == "yellow-light" ? "selected" : "" }}>Laranja/Branco</option>
            <option value="red-light" {{ $user->skin == "red-light" ? "selected" : "" }}>Vermelho/Branco</option>
            <option value="green-light" {{ $user->skin == "green-light" ? "selected" : "" }}>Verde/Branco</option>
        </select>

        @if($errors->has('skin'))
        <span class='invalid-feedback text-red'>
            {{ $errors->first('skin') }}
        </span>
        @endif
    </div>
</div>
