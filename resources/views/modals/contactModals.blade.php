<div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
    <div class="mt-3">
        <h3 class="text-lg font-medium text-gray-900 mb-4" id="modalTitle">Nouveau contact</h3>
        <form id="contactForm" method="POST" action="{{ route('contacts.store') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Nom complet
                </label>
                <input type="text" name="name" id="name" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input type="email" name="email" id="email" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                    Téléphone
                </label>
                <input type="tel" name="phone" id="phone" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                    Catégorie
                </label>
                <select name="category" id="category" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="ami">Ami</option>
                    <option value="famille">Famille</option>
                    <option value="professionnel">Professionnel</option>
                    <option value="collegue">Collègue</option>
                </select>
            </div>
            <div class="mb-4 flex items-center space-x-2">
                <button type='button' onclick="addRelatedContact()"
                    class="flex items-center bg-blue-600 text-white px-3 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <i class="fas fa-plus mr-2"></i>
                    Related Contacts
                </button>
            </div>
            <div id="relatedContactsSection" class="mb-4">
                <!-- Les paires de select seront ajoutées ici dynamiquement -->
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeModal('contactModal')"
                    class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    Annuler
                </button>
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let relatedContactCount = 0;

function addRelatedContact() {
    if (relatedContactCount >= 3) {
        alert('Vous ne pouvez pas ajouter plus de 3 relations');
        return;
    }

    const relatedContactsSection = document.getElementById('relatedContactsSection');
    const contactPair = document.createElement('div');
    contactPair.className = 'mb-4 border p-4 rounded-lg';
    contactPair.innerHTML = `
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="relatedContact${relatedContactCount}">
                Contact lié
            </label>
            <select name="relatedContacts[]" id="relatedContact${relatedContactCount}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Sélectionner un contact</option>
                <!-- Les contacts seront chargés dynamiquement ici -->
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="relationshipType${relatedContactCount}">
                Type de relation
            </label>
            <select name="relationshipTypes[]" id="relationshipType${relatedContactCount}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Sélectionner un type de relation</option>
                <option value="friend">Ami</option>
                <option value="sibling">Frère/Soeur</option>
                <option value="cousin">Cousin(e)</option>
                <option value="spouse">Conjoint(e)</option>
                <option value="parent_of">Parent de</option>
                <option value="child_of">Enfant de</option>
                <option value="mentor_of">Mentor de</option>
                <option value="mentee_of">Mentoré de</option>
            </select>
        </div>
        <button type="button" onclick="removeRelatedContact(this)"
            class="text-red-600 hover:text-red-800 text-sm">
            <i class="fas fa-trash mr-1"></i>Supprimer cette relation
        </button>
    `;

    relatedContactsSection.appendChild(contactPair);
    relatedContactCount++;
}

function removeRelatedContact(button) {
    const contactPair = button.parentElement;
    contactPair.remove();
    relatedContactCount--;
}
</script>