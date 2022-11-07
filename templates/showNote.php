<div class="font-sans aling-center">
    <h1 class="font-sans break-normal text-gray-900 pt-6 pb-2 text-xl">Show
        note</h1>
    <hr class="border-b border-gray-400">
</div>

<div class="mt-6">
    <div class="mb-6">
        <h2 class="text-2xl mt-0 text-purple-600">Title:</h2>
        <span class="mb-6 w-1/3">
<strong>
                <?= htmlentities($params['title']) ?>
</strong>
        </span>
        <div class="mb-6 w-5/6">
            <h2 class="text-2xl mt-2 text-purple-600">Note body</h2>
            <div>
                <?= htmlentities($params['note']) ?>
            </div>
        </div>
    </div>

    <a href="/?action=editNote&id=<?= $params['id'] ?>">
        <button id="editButton"
                class="editBtn bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
            Edit
        </button>
    </a>

    <a href="/">
        <button id="returnBtn"
                class="editBtn bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
            Back to homepage
        </button>
    </a>
</div>