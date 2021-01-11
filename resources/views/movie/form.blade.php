
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
            <label for="nazovFilmu">Názov filmu</label>
            <input type="text" class="form-control" name="nazov" value="{{ old('nazov', @$model->nazov) }}" required>
        </div>

        <div class="form-group">
            <label for="zanerFilmu">Žáner filmu</label>
            <select class="form-control" name="zaner" required>
                <option selected>{{@$model->zaner}}</option>
                <option>akcny</option>
                <option>scifi</option>
                <option>horror</option>
            </select>
        </div>

        <div class="form-group">
            <label for="popisFilmu">Popis filmu</label>
            <textarea class="form-control" rows="4" name="popis" required>{{old('popis', @$model->popis)}} </textarea>
        </div>

        <div class="form-group">
            <label for="obrazokFilmu " >Obrázok filmu</label>
            <input type="text" class="form-control" name="img" value="{{old('img', @$model->img)}}">
        </div>
        <br>
        <button type="submit" class="btn btn-dark">Potvrdiť</button>
    </form>

</div>
