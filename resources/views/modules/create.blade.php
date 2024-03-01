<x-guest-layout>
    <div class="mx-auto container px-6 py-4">
        <div class="mx-auto p-4 mt-20 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <h1 class="text-2xl font-bold mb-6">Create Module</h1>
            <form method="POST" action="{{ route('modules.store') }}" class="space-y-4">
                @csrf
                <div id="modules-container">
{{--                    Module and content fields will be added here dynamically--}}
                </div>
                <button type="button" id="add-module-btn"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Add Module
                </button>
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Submit
                </button>
            </form>
        </div>
    </div>

    <script>
        let moduleIndex = 0;

        const initForm = () => {
            let moduleContainer = document.getElementById('modules-container');
            let moduleDiv = document.createElement('div');
            moduleDiv.classList.add('module', 'p-4', 'border', 'border-gray-200', 'rounded', 'space-y-2');
            moduleDiv.innerHTML = `
                <div class="flex items-center space-x-2">
                    <label class="block">Module Name:</label>
                    <input type="text" name="modules[${moduleIndex}][name]" class="flex-1 border-gray-300 rounded p-2">
                </div>
                <div class="contents-container space-y-2"></div>
                <button type="button" onclick="addContent(this, ${moduleIndex})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                    Add Content
                </button>
                <button type="button" onclick="removeModule(this)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                    Remove Module
                </button>
            `;
            moduleContainer.appendChild(moduleDiv);
        }

        initForm()

        document.getElementById('add-module-btn').addEventListener('click', function () {
            addModule();
        });

        function addModule() {
            initForm()

            moduleIndex++;
        }

        function addContent(button, moduleIdx) {
            let contentsContainer = button.previousElementSibling;
            let contentIndex = contentsContainer.children.length;
            let contentDiv = document.createElement('div');
            contentDiv.classList.add('content', 'flex', 'items-center', 'space-x-2');
            contentDiv.innerHTML = `
                <label class="block">Content Name:</label>
                <input type="text" name="modules[${moduleIdx}][contents][${contentIndex}][name]" class="flex-1 border-gray-300 rounded p-2">
                <button type="button" onclick="removeContent(this)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                    Remove Content
                </button>
            `;
            contentsContainer.appendChild(contentDiv);
        }

        function removeModule(button) {
            button.parentElement.remove();
        }

        function removeContent(button) {
            button.parentElement.remove();
        }
    </script>
</x-guest-layout>
