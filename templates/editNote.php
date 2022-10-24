<div class="font-sans aling-center">
    <h1 class="font-sans break-normal text-gray-900 pt-6 pb-2 text-xl">Edit
        note</h1>
    <hr class="border-b border-gray-400">
</div>

<div class="mt-6">
    <form action="/?action=editNote&id=<?= $params['id'] ?>" method="POST" name="updateExistingNote"
          class="">
        <div class="grid gap-6 mb-6 md:grid-cols-1">
            <div class="mb-6 w-1/3">
                <label for="title"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Note
                    title</label>
                <input name="title" type="text"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="<?= htmlentities(
                           $params['title']
                       ) ?>" required>
            </div>
            <div class="mb-6 w-1/2">
                <label for="note"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Note</label>
                <textarea name="note" placeholder="<?= htmlentities(
                    $params['note']
                ) ?>"
                          class="h-24 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                          required></textarea>
            </div>
        </div>
        <input type="submit" value="Submit"
               class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    </form>

</div>