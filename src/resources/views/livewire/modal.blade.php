<div>
    <form wire:submit.prevent="save" class="modal-form">
        <label>
            <span class="label">日付 <span class="required">必須</span></span>
            <input type="date" wire:model="date" class="input" required/>
            @error('date')
                <span class="error">{{ $message }}</span>
            @enderror
        </label>

        <label>
            <span class="label">体重 <span class="required">必須</span></span>
            <input type="number" step="0.1" wire:model="weight" class="input" placeholder="50.0" required/>
            @error('weight')
                <span class="error">{{ $message }}</span>
            @enderror
        </label>

        <label>
            <span class="label">摂取カロリー <span class="required">必須</span></span>
            <input type="number" wire:model="calories" class="input" placeholder="1200"required/>
            <span>cal</span>
            @error('calories')
                <span class="error">{{ $message }}</span>
            @enderror
        </label>

        <label>
            <span class="label">運動時間 <span class="required">必須</span></span>
            <input type="time" wire:model="exercise_time" class="input" placeholder="00:00" required/>
            @error('exercise_time')
                <span class="error">{{ $message }}</span>
            @enderror
        </label>

        <label>
            <span class="label">運動内容</span>
            <textarea wire:model="exercise_content" class="textarea" placeholder="運動の内容を追加"></textarea>
            @error('exercise_content')
                <span class="error">{{ $message }}</span>
            @enderror
        </label>

        <div class="modal-buttons">
            <button type="button" @click="$dispatch('close-modal')" class="button btn-secondary">戻る</button>
            <button type="submit" class="button btn-primary">登録</button>
        </div>
    </form>
</div>
