<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ trans('MediaManager::messages.title') }}</title>

    {{-- Styles --}}
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
</head>

<body>
    <section id="app" v-cloak>
        {{-- notifications --}}
        <div class="notif-container">
            <my-notification></my-notification>
        </div>

        <example-comp inline-template>
            <div>
                {{-- manager --}}
                <div v-if="inputName">@include('MediaManager::extras.modal')</div>

                {{-- items selector --}}
                <media-modal item="cover" :name="inputName"></media-modal>
                <media-modal item="gallery" :name="inputName" type="folder"></media-modal>
                <media-modal item="links" :name="inputName" :multi="true"></media-modal>

                {{-- for editor --}}
                @include('MediaManager::extras.editor')

                {{-- form --}}
                <form>
                    {{-- cover --}}
                    <section>
                        <img :src="cover" width="500">
                        <input type="hidden" name="cover" :value="cover" />
                        <button id="modalcover" @click="toggleModalFor('cover')">select cover</button>
                    </section>

                    {{-- gallery --}}
                    <section>
                        <input type="text" name="gallery" :value="gallery" />
                        <button id="modalgallery" @click="toggleModalFor('gallery')">select gallery folder</button>
                    </section>

                    {{-- links --}}
                    <section>
                        <input v-for="item in links" :key="item" :value="item" type="text" name="links[]" />

                        <button id="modallink" @click="toggleModalFor('links')">select gallery links</button>
                    </section>

                    // ...
                </form>
            </div>
        </example-comp>
    </section>

    {{-- footer --}}
    @stack('styles')
    @stack('scripts')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>
        document.getElementById("modalcover").addEventListener("click",function (e) {
            e.preventDefault();
        })
        document.getElementById("modalgallery").addEventListener("click",function (e) {
            e.preventDefault();
        })
        document.getElementById("modallink").addEventListener("click",function (e) {
            e.preventDefault();
        })
    </script>
</body>

</html>