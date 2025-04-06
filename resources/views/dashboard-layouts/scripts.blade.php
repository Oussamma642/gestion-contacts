<script>
// Animation for displaying errors if a contact alreadt exits in the reciever
document.addEventListener('DOMContentLoaded', function() {
    const notification = document.getElementById('error-notification');
    if (notification) {
        // Auto-dismiss after 10 seconds
        setTimeout(() => {
            notification.classList.add('animate-fadeOut');
            setTimeout(() => notification.remove(), 500);
        }, 10000);
    }
});

// function acceptContact(contactId) {
//     // Define the target form and action
//     // document.getElementById('acceptSharedContactModal').classList.remove('hidden');
//     document.getElementById('sharedContactsModal').classList.add('hidden');

//     const form = document.getElementById('acceptForm');
//     form.action = `/accept-shared-contact/${contactId}`;

//     // Spoof the method if needed
//     let methodInput = form.querySelector('input[name="_method"]');
//     if (!methodInput) {
//         methodInput = document.createElement('input');
//         methodInput.type = 'hidden';
//         methodInput.name = '_method';
//         form.appendChild(methodInput);
//     }
//     methodInput.value = 'POST';

//     // Fetch the contact details
//     fetch(`/contacts/${contactId}`)
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error('Failed to fetch contact details.');
//             }
//             return response.json();
//         })
//         .then(data => {
//             console.log(data); // Check the output
//             document.getElementById('name').value = data.name;
//             document.getElementById('email').value = data.email;
//             document.getElementById('phone').value = data.phone;
//             document.getElementById('category').value = data.category;
//             document.getElementById('acceptSharedContactModal').classList.remove('hidden');
//         })
//         .catch(error => {
//             console.error('Error fetching contact details:', error);
//         });

// }

// function acceptContact(contactId) {
//     document.getElementById('acceptSharedContactModal').classList.remove('hidden');
//     document.getElementById('sharedContactsModal').classList.add('hidden');

//     const form = document.getElementById('acceptForm');
//     form.action = `/accept-shared-contact/${contactId}`;

//     // Spoof the method if needed
//     let methodInput = form.querySelector('input[name="_method"]');
//     if (!methodInput) {
//         methodInput = document.createElement('input');
//         methodInput.type = 'hidden';
//         methodInput.name = '_method';
//         form.appendChild(methodInput);
//     }
//     methodInput.value = 'POST';

//     fetch(`/contacts/${contactId}`)
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error('Failed to fetch contact details.');
//             }
//             return response.json();
//         })
//         .then(data => {
//             console.log(data);
//             document.getElementById('name').value = data.name;
//             document.getElementById('email').value = data.email;
//             document.getElementById('phone').value = data.phone;
//             document.getElementById('category').value = data.category;
//         })
//         .catch(error => {
//             console.error('Error fetching contact details:', error);
//         });
// }


function acceptContact(contactId) {
    document.getElementById('acceptSharedContactModal').classList.remove('hidden');

    const form = document.getElementById('acceptForm');
    form.action = `/accept-shared-contact/${contactId}`;

    let methodInput = form.querySelector('input[name="_method"]');
    if (!methodInput) {
        methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        form.appendChild(methodInput);
    }
    methodInput.value = 'POST';

    fetch(`/contacts/${contactId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to fetch contact details.');
            }
            return response.json();
        })
        .then(data => {
            console.log(data); // Check this in the console to confirm data structure
            document.getElementById('name').value = data.name || '';
            document.getElementById('email').value = data.email || '';
            document.getElementById('phone').value = data.phone || '';
            document.getElementById('category').value = data.category || 'ami';
        })
        .catch(error => {
            console.error('Error fetching contact details:', error);
        });
}

function rejectContact(shareId) {
    fetch(`/shared-contacts/${shareId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        })
        .then(response => {
            if (response.ok) {
                // Remove the rejected contact from the modal
                const row = document.querySelector(`tr[data-share-id="${shareId}"]`);
                if (row) {
                    row.remove();
                }

                // Decrement the pending count
                const countBadge = document.getElementById('sharedContactsCount');
                let pendingCount = parseInt(countBadge.textContent);
                if (!isNaN(pendingCount) && pendingCount > 0) {
                    pendingCount -= 1;
                    countBadge.textContent = pendingCount;

                    // Hide the badge if count reaches zero
                    if (pendingCount === 0) {
                        countBadge.classList.add('hidden');
                    }
                }
            } else {
                console.error('Failed to reject contact');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function openSharedContactsModal() {
    const modal = document.getElementById('sharedContactsModal');
    modal.classList.remove('hidden');

    fetch('/shared-contacts') // Fetch pending shared contacts
        .then(response => response.json())
        .then(sharedContacts => {
            const tableBody = document.getElementById('sharedContactsTable');
            tableBody.innerHTML = ''; // Clear previous data
            // contacts.id
            // Populate the table with shared contacts
            sharedContacts.forEach(contact => {
                tableBody.innerHTML += `
                    <tr data-share-id="${contact.share_id}">
                        <td class="px-3 sm:px-6 py-4 whitespace-nowrap">${contact.name}</td>
                        <td class="px-3 sm:px-6 py-4 whitespace-nowrap">${contact.sender_name} Contact Id: ${contact.id} Shared-Contact Id: ${contact.share_id}</td>
                        <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                            <button type="button" onclick="acceptContact(${contact.id})" class="bg-blue-500 text-white px-2 py-1 rounded">Accept</button>
                            <button type="button" onclick="rejectContact(${contact.share_id})" class="bg-red-500 text-white px-2 py-1 rounded">Reject</button>
                        </td>
                    </tr>
                `;
            });
        })
        .catch(error => {
            console.error('Error fetching shared contacts:', error);
        });
}


// Count Pending Shared Contacts
function fetchSharedContactsCount() {
    fetch('/shared-contacts') // API to get pending shared contacts
        .then(response => response.json())
        .then(sharedContacts => {
            const pendingCount = sharedContacts.length; // Count the pending contacts
            const countBadge = document.getElementById('sharedContactsCount');
            countBadge.textContent = pendingCount;

            // Hide the badge if there are no pending contacts
            if (pendingCount === 0) {
                countBadge.classList.add('hidden');
            } else {
                countBadge.classList.remove('hidden');
            }
        })
        .catch(error => {
            console.error('Error fetching shared contacts count:', error);
        });
}

// Call the function when the page loads
document.addEventListener('DOMContentLoaded', fetchSharedContactsCount);

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}

function openUsersModal() {
    // Show the modal only if at least one contact is selected
    const selectedContacts = document.querySelectorAll('input[name="contact_ids[]"]:checked');
    if (selectedContacts.length === 0) {
        alert('Please select at least one contact to share.');
        return;
    }

    // Fetch the authenticated user's ID (you need to pass it from your backend to the frontend)
    const authUserId = document.getElementById('authUserId').value; // Example of how to pass it to your frontend

    // Show the modal
    document.getElementById('usersModal').classList.remove('hidden');

    // Fetch the users
    fetch('/users')
        .then(response => response.json())
        .then(users => {
            const userDropdown = document.getElementById('userDropdown');
            userDropdown.innerHTML = ''; // Clear any existing options

            // Populate the dropdown with user data, excluding the authenticated user
            users.forEach(user => {
                if (user.id !== parseInt(authUserId)) {
                    userDropdown.innerHTML += `
                        <option value="${user.id}">${user.name} (${user.email})</option>
                    `;
                }
            });
        })
        .catch(error => {
            console.error('Error fetching users:', error);
        });
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}

function toggleSelectAllUsers(source) {
    const checkboxes = document.querySelectorAll('input[name="user_ids[]"]');
    checkboxes.forEach(checkbox => {
        checkbox.checked = source.checked;
    });
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}

function toggleSelectAll(source) {
    const checkboxes = document.querySelectorAll('input[name="contact_ids[]"]');
    checkboxes.forEach(checkbox => {
        checkbox.checked = source.checked;
    });
}

// Add this function and event listeners
function setupCheckboxListeners() {
    const selectAllCheckbox = document.getElementById('selectAll');
    const individualCheckboxes = document.querySelectorAll('input[name="contact_ids[]"]');

    // Add event listeners to each individual checkbox
    individualCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            // If any checkbox is unchecked, uncheck the "select all" checkbox
            if (!checkbox.checked) {
                selectAllCheckbox.checked = false;
            }
            // If all checkboxes are checked, check the "select all" checkbox
            else if (Array.from(individualCheckboxes).every(cb => cb.checked)) {
                selectAllCheckbox.checked = true;
            }
        });
    });
}

// Call this when the page loads
document.addEventListener('DOMContentLoaded', setupCheckboxListeners);

function openAddModal() {
    document.getElementById('modalTitle').textContent = 'Nouveau contact';
    document.getElementById('contactForm').reset();
    document.getElementById('contactForm').action = "{{ route('contacts.store') }}";
    document.getElementById('contactModal').classList.remove('hidden');
}

function openEditModal(contactId) {
    document.getElementById('modalTitle').textContent = 'Modifier le contact';

    // Ajuster le formulaire pour la méthode PUT
    const form = document.getElementById('contactForm');
    form.action = `/contacts/${contactId}`;

    // Ajouter le method spoofing pour PUT
    let methodInput = document.querySelector('input[name="_method"]');
    if (!methodInput) {
        methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        form.appendChild(methodInput);
    }
    methodInput.value = 'PUT';

    // Charger les données du contact
    fetch(`/contacts/${contactId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('name').value = data.name;
            document.getElementById('email').value = data.email;
            document.getElementById('phone').value = data.phone;
            document.getElementById('category').value = data.category;
            document.getElementById('contactModal').classList.remove('hidden');
        });
}

function closeModal(modelType) {

    if (modelType === "acceptSharedContactModal") {
        document.getElementById(modelType).classList.add('hidden');
        openSharedContactsModal();
    }
    document.getElementById(modelType).classList.add('hidden');

}


function deleteContact(contactId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce contact ?')) {
        // Créer un formulaire pour la soumission
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/contacts/${contactId}`;

        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';

        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';

        form.appendChild(csrfInput);
        form.appendChild(methodInput);
        document.body.appendChild(form);
        form.submit();
    }
}

function showRelatedPersons(contactId) {
    // Cette fonction afficherait normalement une fenêtre modale ou redirigerait
    // vers une page montrant les personnes liées au contact
    alert(`Affichage des personnes liées au contact #${contactId}`);
    // Ici vous pourriez implémenter un appel fetch pour récupérer et afficher
    // les personnes liées à ce contact
}
</script>