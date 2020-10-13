<ul class="checkbox-list">
    @foreach($categories as $category)
        <li>
            <div class="checkbox">
                <label>
                    <input
                            @if (isset($model))
                            {{ $model->categories->contains($category) ? 'checked' : '' }}    
                            @endif
                            
                            type="checkbox"
                            name="categories[]"
                            value="{{ $category->id }}">
                    {{ $category->name }}
                </label>
            </div>
        </li>

       
        
    @endforeach
</ul>  