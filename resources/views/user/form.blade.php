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
            <label>Meno užívateľa</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', @$model->name) }}" required>
        </div>

        <div class="form-group">
            <label>Email užívateľa</label>
            <input type="text" class="form-control" name="email" value="{{ old('email', @$model->email) }}" required>
        </div>

        <div class="form-group">
            <label>Heslo</label>
            <input type="password" class="form-control" name="password" value="" required>
        </div>

        <div class="form-group">
            <label>Potvrdenie hesla</label>
            <input type="password" class="form-control" name="passwordConfirmation" value="" required>
        </div>

        <div class="form-group">
            <label>Rola užívateľa</label>
            <select class="form-control" name="role" required>
                <option label="Zvoľ rolu" selected>{{@$model->role}}</option>
                <option value='user'>Užívateľ</option>
                <option value='admin'>Administrátor</option>
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-dark">Potvrdiť</button>
    </form>

</div>
