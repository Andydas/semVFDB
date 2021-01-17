<div class="form-group text-danger">
    @foreach($errors->all() as $error)
        {{$error}} <br>
    @endforeach
</div>

<div class="container">


    <form method="post" action="{{$action}}">
        @csrf
        @method($method)
        <div class="form-group">
            <label for="menoUzivatela">Meno užívateľa</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', @$model->name) }}" required>
        </div>

        <div class="form-group">
            <label for="emailUzivatela">Email užívateľa</label>
            <input type="text" class="form-control" name="email" value="{{ old('email', @$model->email) }}" required>
        </div>

        <div class="form-group">
            <label for="hesloUzivatela">Heslo</label>
            <input type="password" class="form-control" name="password" value="" required>
        </div>

        <div class="form-group">
            <label for="hesloUzivatelaPotrvdenie">Potvrdenie hesla</label>
            <input type="password" class="form-control" name="passwordConfirmation" value="" required>
        </div>

        <div class="form-group">
            <label for="rolaUzivatela">Roľa užívateľa</label>
            <select class="form-control" name="role" required>
                <option selected>{{@$model->role}}</option>
                <option value="user">Užívateľ</option>
                <option value="admin">Administrátor</option>
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-dark">Potvrdiť</button>
    </form>

</div>
