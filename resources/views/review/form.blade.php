
<div class="form-group text-danger">
    @foreach($errors->all() as $error)
        {{$error}} <br>
    @endforeach
</div>

<div class="container">


    <form method="post" action="{{$action}}">
        @csrf
        @method($method)

        @if(isset($movie))
        <input type="hidden" id="movie" name="movie" value="{{$movie->id}}">
        @endif
        <div class="form-group">
            <label for="popisFilmu">Popis hodnotenia</label>
            <textarea class="form-control" rows="4" name="popis" required>{{old('popis', @$model->popis)}} </textarea>
        </div>


        <div class="form-group">
            <label for="hodnotenie">Hodnotenie</label>
            <select class="form-control" name="hodnotenie" required>
                <option selected>{{@$model->hodnotenie}}</option>
                <option>0</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-dark">Potvrdiť</button>
    </form>

</div>
