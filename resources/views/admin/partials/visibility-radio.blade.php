 <div class="form-group">
    <div class="form-check">
        <input class="form-check-input" type="radio" name="visibility" value="1" 
        id="defaultCheck1" {{ $model->visibility ? 'checked': '' }} >
        <label class="form-check-label" for="defaultCheck1">
            Visible
        </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" value="0" name="visibility" 
           id="defaultCheck2" {{ $model->visibility ? '' : 'checked'  }}>
          <label class="form-check-label" for="defaultCheck2" >
            Hidden
          </label>
    </div>
</div>