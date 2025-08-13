<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import LayoutAdmin from '@Layout/LayoutAdmin.vue';
import LayoutClient from '@Layout/LayoutClient.vue';

const page = usePage();

// Get the authenticated user from the Inertia page props
const user = computed(() => page.props.auth.user);

/**
 * Checks if the user has the 'admin' role.
 * This assumes the backend passes a 'roles' array on the user object.
 * The roles array will contain objects with a 'name' property, e.g., [{ id: 1, name: 'admin' }, { id: 2, name: 'client' }].
 */
const hasAdminAccess = computed(() => {
  // We check if the user object exists, and if it has a 'roles' property.
  // Then we use the `.some()` method to check if any role in the array has the name 'admin'.
  return user.value && user.value.roles && user.value.roles.some(role => role.name === 'admin');
});
</script>

<template>
  <div class="min-h-screen bg-gray-50">
    <!-- 
      Conditionally render the correct layout based on the user's roles.
      If the user has the 'admin' role, they get the admin layout.
      Otherwise, all other users (including clients) get the client layout.
    -->
    <LayoutAdmin v-if="hasAdminAccess">
      <slot />
    </LayoutAdmin>
    <LayoutClient v-else>
      <slot />
    </LayoutClient>
  </div>
</template>
