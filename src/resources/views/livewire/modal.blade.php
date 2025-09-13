<div>
    @if($open)
        <div class="modal is-open">
            <div class="modal__overlay" wire:click="close"></div>

            <div class="modal__panel">
                <div class="modal__header">
                    <h3>Weight Logを追加</h3>
                </div>

                <form wire:submit.prevent="save" class="modal__body">
                    <label class="modal__field">
                        <span class=field-title>日付 <span class="required">必須</span></span>
                        <input type="date" wire:model.defer="date" class="input">
                        @error('date')
                            <span class="error">
                                {{ $message }}
                            </span>
                        @enderror
                    </label>

                    <label class="modal__field">
                        <span class=field-title>体重 <span class="required">必須</span></span>
                        <div class="input-with-suffix">
                            <input type="text" wire:model.defer="weight" class="input input-weight" placeholder="50.0">
                            <span>kg</span>
                        </div>
                        @error('weight')
                            <span class="error">
                                {{ $message }}
                            </span>
                        @enderror
                    </label>

                    <label class="modal__field">
                        <span class=field-title>摂取カロリー <span class="required">必須</span></span>
                        <div class="input-with-suffix">
                            <input type="number" wire:model.defer="calories" class="input input-calories" placeholder="1200">
                            <span>cal</span>
                        </div>
                        @error('calories')
                            <span class="error">
                                {{ $message }}
                            </span>
                        @enderror
                    </label>

                    <label class="modal__field">
                        <span class=field-title>運動時間 <span class="required">必須</span></span>
                        <input type="time" wire:model.defer="exercise_time" class="input input-time" placeholder="00:00">
                        @error('exercise_time')
                            <span class="error">
                                {{ $message }}
                            </span>
                        @enderror
                    </label>

                    <label class="modal__field">
                        <span class=field-title>運動内容</span>
                        <textarea wire:model.defer="exercise_content" class="textarea" placeholder="運動の内容を追加"></textarea>
                        @error('exercise_content')
                            <span class="error">
                                {{ $message }}
                            </span>
                        @enderror
                    </label>

                    <div class="modal__footer">
                        <button type="button" class="button btn-secondary" wire:click="close">戻る</button>
                        <button type="submit" class="button btn-primary">登録</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
