<div class="font-sans aling-center">
    <h1 class="font-sans break-normal text-gray-900 pt-6 pb-2 text-xl">Notes
        list</h1>
    <hr class="border-b border-gray-400">
</div>

<?php
$sortBy = $params['sort']['by'];
$sortOrder = $params['sort']['order'];
?>

<div class="mt-5 flex flex-col justify-center">
    <div>
    <div>Sort by:</div>
    <form method="GET" action="/">
        <fieldset id="sortby">
        <input type="radio" name="sortby" value="title" <?= $sortBy === 'title' ? 'checked' : ''; ?>><span class="pl-2">Title</span>
        <input type="radio" name="sortby" value="creationDate" <?= $sortBy === 'creationDate' ? 'checked' : ''; ?>><span class="pl-2">Date</span>
        </fieldset>

        <fieldset id="sortorder">
            <input type="radio" name="sortorder" value="asc" <?= $sortOrder === 'asc' ? 'checked' : ''; ?>><span class="pl-2">Ascending</span>
            <input type="radio" name="sortorder" value="desc" <?= $sortOrder === 'desc' ? 'checked' : ''; ?>><span class="pl-1">Descending</span>
        </fieldset>

        <input type="submit" value="Sort" class="mt-1 cursor-pointer bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
    </form>
    </div>

    <?php if($params['searchPhrase'] != ''): ?>
    <div>
        <span><strong>Search results for:</strong> <?= $params['searchPhrase'] ?></span>
    </div>
    <?php endif; ?>
</div>

    <div class="mt-6 overflow-x-auto relative">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="py-3 px-6">
                Title
            </th>
            <th scope="col" class="py-3 px-6">
                Note
            </th>
            <th scope="col" class="py-3 px-6">
                Created
            </th>
            <th scope="col" class="py-3 px-6">
                Actions
            </th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($params['notes'] as $note): ?>
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row"
                class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                <?= htmlentities($note['title']) ?>
            </th>
            <td class="py-4 px-6">
                <?= htmlentities($note['note']) ?>
            </td>
            <td class="py-4 px-6">
                <?= htmlentities($note['creationDate']) ?>
            </td>
            <td class="py-4 px-6">
                <form method="POST" action="/?action=deleteNote" class="inline-block">

                    <input type="hidden" name="deleteNote" value="<?= $note['id'] ?>">
                    <button type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                        Delete
                    </button>
                    </form>

                <a href="/?action=editNote&id=<?= $note['id'] ?>">
                    <button id="editButton"
                            class="editBtn bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                        Edit
                    </button>
                </a>
            </td>
        </tr>
        </tbody>
        <?
        endforeach; ?>
    </table>

</div>



