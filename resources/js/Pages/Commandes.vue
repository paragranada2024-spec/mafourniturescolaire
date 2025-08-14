<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50/30 to-indigo-50/20">
    <!-- Header -->


    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8">
      <!-- Metrics Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 border border-slate-200/60 hover:shadow-lg transition-all duration-300">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-2">Total Orders</p>
              <p class="text-3xl font-bold text-slate-800">{{ commands.length }}</p>
              <p class="text-xs text-slate-400 mt-1">All time</p>
            </div>
            <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center">
              <FileText class="w-6 h-6 text-slate-600" />
            </div>
          </div>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-amber-200/60 hover:shadow-lg transition-all duration-300">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-xs font-semibold text-amber-600 uppercase tracking-wide mb-2">Pending</p>
              <p class="text-3xl font-bold text-amber-700">{{ pendingCount }}</p>
              <p class="text-xs text-amber-500 mt-1">Awaiting action</p>
            </div>
            <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center">
              <Clock class="w-6 h-6 text-amber-600" />
            </div>
          </div>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-emerald-200/60 hover:shadow-lg transition-all duration-300">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wide mb-2">Completed</p>
              <p class="text-3xl font-bold text-emerald-700">{{ completedCount }}</p>
              <p class="text-xs text-emerald-500 mt-1">Successfully done</p>
            </div>
            <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center">
              <CheckCircle class="w-6 h-6 text-emerald-600" />
            </div>
          </div>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-red-200/60 hover:shadow-lg transition-all duration-300">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-xs font-semibold text-red-600 uppercase tracking-wide mb-2">Cancelled</p>
              <p class="text-3xl font-bold text-red-700">{{ cancelledCount }}</p>
              <p class="text-xs text-red-500 mt-1">Terminated</p>
            </div>
            <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center">
              <XCircle class="w-6 h-6 text-red-600" />
            </div>
          </div>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-indigo-200/60 hover:shadow-lg transition-all duration-300">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-xs font-semibold text-indigo-600 uppercase tracking-wide mb-2">Pack Plus</p>
              <p class="text-3xl font-bold text-indigo-700">{{ packPlusCount }}</p>
              <p class="text-xs text-indigo-500 mt-1">Premium orders</p>
            </div>
            <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center">
              <Star class="w-6 h-6 text-indigo-600" />
            </div>
          </div>
        </div>
      </div>

      <!-- Filters -->
      <div class="bg-white rounded-2xl border border-slate-200/60 p-6 mb-8 shadow-sm">
        <div class="flex flex-col lg:flex-row gap-6">
          <div class="relative flex-1">
            <Search class="absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400 w-5 h-5" />
            <input
              v-model="searchTerm"
              type="text"
              placeholder="Search by name, city, or phone..."
              class="w-full pl-12 pr-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-300 focus:border-slate-400 transition-all duration-200 bg-slate-50/50 text-slate-800 placeholder-slate-400 font-medium"
            />
          </div>
          <div class="flex gap-3 flex-wrap">
            <button
              v-for="filter in statusFilters"
              :key="filter.value"
              @click="statusFilter = filter.value"
              class="px-6 py-3 rounded-xl font-semibold text-sm transition-all duration-200 flex items-center gap-2"
              :class="statusFilter === filter.value ? 'bg-slate-800 text-white shadow-lg' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 border border-slate-200'"
            >
              <Filter v-if="filter.value === 'all'" class="w-4 h-4" />
              <Clock v-else-if="filter.value === 'pending'" class="w-4 h-4" />
              <CheckCircle v-else-if="filter.value === 'done'" class="w-4 h-4" />
              <XCircle v-else-if="filter.value === 'cancelled'" class="w-4 h-4" />
              {{ filter.label }}
            </button>
          </div>
        </div>
      </div>

      <!-- Orders Table/Cards -->
      <div class="bg-white rounded-2xl border border-slate-200/60 overflow-hidden shadow-sm">
        <!-- Desktop Table -->
        <div class="hidden lg:block">
          <div class="overflow-x-auto">
            <table class="w-full">
              <thead class="bg-slate-50/80 border-b border-slate-200">
                <tr>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wide">Customer</th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wide">Contact</th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wide">Price</th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wide">Pack Type</th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wide">Files</th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wide">Notes</th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wide">Status</th>
                  <th class="px-6 py-4 text-center text-xs font-semibold text-slate-600 uppercase tracking-wide">Actions</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
                <tr
                  v-for="command in filteredCommands"
                  :key="command.id"
                  class="hover:bg-slate-50/50 transition-all duration-200"
                >
                  <td class="px-6 py-4">
                    <div class="flex items-center">

                      <div class="font-semibold text-slate-800">{{ command.name }}</div>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <div class="space-y-2">
                      <div class="flex items-center gap-2 text-sm text-slate-600">
                        <Phone class="w-4 h-4 text-slate-400" />
                        {{ command.telephone }}
                      </div>
                      <div class="flex items-center gap-2 text-sm text-slate-600">
                        <MapPin class="w-4 h-4 text-slate-400" />
                        {{ command.ville }}
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <!-- Added inline price editing functionality -->
                    <div class="flex items-center gap-2">
                      <DollarSign class="w-4 h-4 text-slate-400" />
                      <div v-if="editingPrice !== command.id" class="flex items-center gap-2">
                        <span class="font-semibold text-slate-800">
                          {{ command.price ? `$${command.price}` : 'Not set' }}
                        </span>
                        <button
                          @click="startEditingPrice(command.id, command.price)"
                          class="p-1.5 text-slate-400 hover:text-slate-600 transition-colors rounded-lg hover:bg-slate-100"
                        >
                          <Edit2 class="w-4 h-4" />
                        </button>
                      </div>
                      <div v-else class="flex items-center gap-2">
                        <input
                          v-model="tempPrice"
                          @keyup.enter="savePrice(command.id)"
                          @keyup.escape="cancelEditingPrice"
                          type="number"
                          step="0.01"
                          placeholder="0.00"
                          class="w-24 px-2 py-1 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-slate-400 focus:border-slate-400"
                          ref="priceInput"
                        />
                        <button
                          @click="savePrice(command.id)"
                          class="p-1.5 text-emerald-600 hover:text-emerald-700 transition-colors rounded-lg bg-emerald-50"
                        >
                          <Check class="w-4 h-4" />
                        </button>
                        <button
                          @click="cancelEditingPrice"
                          class="p-1.5 text-red-600 hover:text-red-700 transition-colors rounded-lg bg-red-50"
                        >
                          <X class="w-4 h-4" />
                        </button>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <!-- Made pack type read-only - removed all editing functionality -->
                    <div class="flex items-center gap-2">
                      <Package class="w-4 h-4 text-slate-400" />
                      <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium"
                            :class="command.pack === 'plus' ? 'bg-indigo-100 text-indigo-800' : 'bg-emerald-100 text-emerald-800'">
                        {{ getPackLabel(command.pack) }}
                      </span>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <!-- Enhanced file handling with image lightbox and download links -->
                    <div class="flex items-center gap-3">
                      <div v-if="command.items && command.items.length > 0" class="flex items-center gap-2">
                        <button
                          @click="openLightbox(getImageFiles(command.items), 0)"
                          v-if="getImageFiles(command.items).length > 0"
                          class="inline-flex items-center gap-2 px-3 py-1.5 bg-slate-600 text-white rounded-lg text-sm font-medium hover:bg-slate-700 transition-all duration-200"
                        >
                          <ImageIcon class="w-4 h-4" />
                          {{ getImageFiles(command.items).length }}
                        </button>
                        <div v-if="getNonImageFiles(command.items).length > 0" class="flex flex-wrap gap-1">
                          <a
                            v-for="item in getNonImageFiles(command.items)"
                            :key="item.id"
                            :href="`/storage/${item.image}`"
                            target="_blank"
                            class="inline-flex items-center gap-1 px-2 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-medium hover:bg-blue-200 transition-all duration-200"
                          >
                            <component :is="getFileIcon(item.image)" class="w-3 h-3" />
                            {{ getFileType(item.image) }}
                            <ExternalLink class="w-3 h-3" />
                          </a>
                        </div>
                      </div>
                      <div v-else class="text-sm text-slate-400">No files</div>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <!-- Added inline notes editing functionality -->
                    <div class="flex items-start gap-2">
                      <FileText class="w-4 h-4 text-slate-400 mt-0.5" />
                      <div v-if="editingNote !== command.id" class="flex items-start gap-2 flex-1">
                        <p class="text-sm text-slate-600 max-w-xs truncate">
                          {{ command.note || 'No notes' }}
                        </p>
                        <button
                          @click="startEditingNote(command.id, command.note)"
                          class="p-1.5 text-slate-400 hover:text-slate-600 transition-colors flex-shrink-0 rounded-lg hover:bg-slate-100"
                        >
                          <Edit2 class="w-4 h-4" />
                        </button>
                      </div>
                      <div v-else class="flex items-start gap-2 flex-1">
                        <textarea
                          v-model="tempNote"
                          @keyup.ctrl.enter="saveNote(command.id)"
                          @keyup.escape="cancelEditingNote"
                          placeholder="Add a note..."
                          rows="2"
                          class="flex-1 px-2 py-1 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-slate-400 focus:border-slate-400 resize-none"
                          ref="noteInput"
                        ></textarea>
                        <div class="flex flex-col gap-1">
                          <button
                            @click="saveNote(command.id)"
                            class="p-1.5 text-emerald-600 hover:text-emerald-700 transition-colors rounded-lg bg-emerald-50"
                          >
                            <Check class="w-4 h-4" />
                          </button>
                          <button
                            @click="cancelEditingNote"
                            class="p-1.5 text-red-600 hover:text-red-700 transition-colors rounded-lg bg-red-50"
                          >
                            <X class="w-4 h-4" />
                          </button>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium"
                          :class="getStatusClasses(command.status)">
                      {{ getStatusLabel(command.status) }}
                    </span>
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex items-center justify-center gap-2" v-if="command.status === 'pending'">
                      <button
                        @click="markDone(command.id)"
                        class="inline-flex items-center px-3 py-1.5 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition-all duration-200"
                      >
                        <Check class="w-4 h-4 mr-1" />
                        Complete
                      </button>
                      <button
                        @click="cancelCommand(command.id)"
                        class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-all duration-200"
                      >
                        <X class="w-4 h-4 mr-1" />
                        Cancel
                      </button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Added mobile responsive cards view -->
        <div class="lg:hidden p-6 space-y-6">
          <div
            v-for="command in filteredCommands"
            :key="command.id"
            class="bg-slate-50/50 border border-slate-200 rounded-2xl p-6 hover:shadow-lg transition-all duration-300 relative"
          >
            <div class="flex justify-between items-start mb-6">
              <div class="flex items-center">

                <div>
                  <h3 class="font-semibold text-slate-800 text-lg">{{ command.name }}</h3>
                  <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium absolute top-4 right-3"
                        :class="getStatusClasses(command.status)">
                    {{ getStatusLabel(command.status) }}
                  </span>
                </div>
              </div>
            </div>

            <div class="space-y-4 mb-6">
              <div class="flex items-center gap-3 text-sm text-slate-600">
                <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center">
                  <Phone class="w-4 h-4 text-blue-600" />
                </div>
                {{ command.telephone }}
              </div>
              <div class="flex items-center gap-3 text-sm text-slate-600">
                <div class="w-8 h-8 bg-green-50 rounded-lg flex items-center justify-center">
                  <MapPin class="w-4 h-4 text-green-600" />
                </div>
                {{ command.ville }}
              </div>

              <!-- Mobile Price Editing -->
              <div class="flex items-center gap-3 text-sm text-slate-600">
                <div class="w-8 h-8 bg-slate-50 rounded-lg flex items-center justify-center">
                  <DollarSign class="w-4 h-4 text-slate-600" />
                </div>
                <div v-if="editingPrice !== command.id" class="flex items-center gap-2 flex-1">
                  <span class="font-semibold text-slate-800">
                    {{ command.price ? `$${command.price}` : 'Price not set' }}
                  </span>
                  <button
                    @click="startEditingPrice(command.id, command.price)"
                    class="p-2 text-slate-400 hover:text-slate-600 transition-colors bg-white rounded-lg border border-slate-200"
                  >
                    <Edit2 class="w-4 h-4" />
                  </button>
                </div>
                <div v-else class="flex items-center gap-2 flex-1">
                  <input
                    v-model="tempPrice"
                    @keyup.enter="savePrice(command.id)"
                    @keyup.escape="cancelEditingPrice"
                    type="number"
                    step="0.01"
                    placeholder="0.00"
                    class="flex-1 px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-slate-400 focus:border-slate-400"
                  />
                  <button
                    @click="savePrice(command.id)"
                    class="p-2 text-emerald-600 hover:text-emerald-700 transition-colors bg-emerald-50 rounded-lg"
                  >
                    <Check class="w-4 h-4" />
                  </button>
                  <button
                    @click="cancelEditingPrice"
                    class="p-2 text-red-600 hover:text-red-700 transition-colors bg-red-50 rounded-lg"
                  >
                    <X class="w-4 h-4" />
                  </button>
                </div>
              </div>

              <!-- Mobile Pack Type Editing -->
              <div class="flex items-center gap-3 text-sm text-slate-600">
                <div class="w-8 h-8 bg-indigo-50 rounded-lg flex items-center justify-center">
                  <Package class="w-4 h-4 text-indigo-600" />
                </div>
                <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium"
                      :class="command.pack === 'plus' ? 'bg-indigo-100 text-indigo-800' : 'bg-emerald-100 text-emerald-800'">
                  {{ getPackLabel(command.pack) }}
                </span>
              </div>

              <!-- Mobile Notes Editing -->
              <div class="mb-6">
                <h4 class="text-sm font-semibold text-slate-700 mb-3 flex items-center gap-2">
                  <div class="w-6 h-6 bg-blue-50 rounded-lg flex items-center justify-center">
                    <FileText class="w-4 h-4 text-blue-600" />
                  </div>
                  Notes:
                </h4>
                <div v-if="editingNote !== command.id" class="flex items-start gap-3">
                  <p class="text-sm text-slate-700 flex-1 bg-white rounded-lg p-3 min-h-[2.5rem] border border-slate-200">
                    {{ command.note || 'No notes added yet' }}
                  </p>
                  <button
                    @click="startEditingNote(command.id, command.note)"
                    class="p-2 text-slate-400 hover:text-slate-600 transition-colors bg-white rounded-lg border border-slate-200"
                  >
                    <Edit2 class="w-4 h-4" />
                  </button>
                </div>
                <div v-else class="flex items-start gap-3">
                  <textarea
                    v-model="tempNote"
                    @keyup.ctrl.enter="saveNote(command.id)"
                    @keyup.escape="cancelEditingNote"
                    placeholder="Add a note..."
                    rows="3"
                    class="flex-1 px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-slate-400 focus:border-slate-400 resize-none"
                  ></textarea>
                  <div class="flex flex-col gap-2">
                    <button
                      @click="saveNote(command.id)"
                      class="p-2 text-emerald-600 hover:text-emerald-700 transition-colors bg-emerald-50 rounded-lg"
                    >
                      <Check class="w-4 h-4" />
                    </button>
                    <button
                      @click="cancelEditingNote"
                      class="p-2 text-red-600 hover:text-red-700 transition-colors bg-red-50 rounded-lg"
                    >
                      <X class="w-4 h-4" />
                    </button>
                  </div>
                </div>
              </div>

              <!-- Mobile Files -->
              <div class="mb-6">
                <h4 class="text-sm font-semibold text-slate-700 mb-3 flex items-center gap-2">
                  <div class="w-6 h-6 bg-slate-50 rounded-lg flex items-center justify-center">
                    <FileText class="w-4 h-4 text-slate-600" />
                  </div>
                  Files:
                </h4>
                <div v-if="command.items && command.items.length > 0" class="flex flex-wrap gap-2">
                  <button
                    v-if="getImageFiles(command.items).length > 0"
                    @click="openLightbox(getImageFiles(command.items), 0)"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-slate-600 text-white rounded-lg text-sm font-medium hover:bg-slate-700 transition-all duration-200"
                  >
                    <ImageIcon class="w-4 h-4" />
                    {{ getImageFiles(command.items).length }} image{{ getImageFiles(command.items).length !== 1 ? 's' : '' }}
                  </button>
                  <a
                    v-for="item in getNonImageFiles(command.items)"
                    :key="item.id"
                    :href="`/storage/${item.image}`"
                    target="_blank"
                    class="inline-flex items-center gap-2 px-3 py-2 bg-blue-100 text-blue-700 rounded-lg text-sm font-medium hover:bg-blue-200 transition-all duration-200"
                  >
                    <component :is="getFileIcon(item.image)" class="w-4 h-4" />
                    {{ getFileType(item.image) }}
                    <ExternalLink class="w-4 h-4" />
                  </a>
                </div>
                <div v-else class="text-sm text-slate-400">
                  No files attached
                </div>
              </div>

              <!-- Mobile Actions -->
              <div v-if="command.status === 'pending'" class="flex gap-3">
                <button
                  @click="markDone(command.id)"
                  class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition-all duration-200"
                >
                  <Check class="w-4 h-4 mr-2" />
                  Complete
                </button>
                <button
                  @click="cancelCommand(command.id)"
                  class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-all duration-200"
                >
                  <X class="w-4 h-4 mr-2" />
                  Cancel
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Empty State -->
        <div v-if="filteredCommands.length === 0" class="p-16 text-center">
          <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
            <Search class="w-8 h-8 text-slate-400" />
          </div>
          <h3 class="text-xl font-semibold text-slate-800 mb-3">No orders found</h3>
          <p class="text-slate-500 max-w-md mx-auto">
            {{ searchTerm || statusFilter !== 'all'
              ? 'Try adjusting your search criteria or filters to find what you\'re looking for.'
              : 'No orders available at the moment. New orders will appear here.' }}
          </p>
        </div>
      </div>
    </div>

    <!-- Added image lightbox modal -->
    <div
      v-if="lightboxOpen"
      @click="closeLightbox"
      class="fixed inset-0 bg-black/40 backdrop-blur-sm z-50 flex items-center justify-center p-4"
    >
      <div class="relative max-w-4xl max-h-full">
        <button
          @click="closeLightbox"
          class="absolute -top-12 right-0 text-white hover:text-gray-300 transition-colors z-10 p-2 rounded-full bg-black/50 hover:bg-black/70"
        >
          <X class="w-6 h-6" />
        </button>

        <div class="relative">
          <div class="flex justify-center">
            <img
              :src="`/storage/${lightboxImages[currentImageIndex]?.image}`"
              :alt="lightboxImages[currentImageIndex]?.image"
              class=" max-h-[350px] object-contain rounded-xl shadow-2xl"
              @click.stop
            />
          </div>

          <div v-if="lightboxImages.length > 1" class="hidden md:block">
            <button
              @click.stop="previousImage"
              class="absolute left-4 top-1/2 transform -translate-y-1/2 p-3 bg-black/50 text-white rounded-full hover:bg-black/70 transition-all duration-200"
            >
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
              </svg>
            </button>

            <button
              @click.stop="nextImage"
              class="absolute right-4 top-1/2 transform -translate-y-1/2 p-3 bg-black/50 text-white rounded-full hover:bg-black/70 transition-all duration-200"
            >
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
            </button>
          </div>
        </div>

        <div v-if="lightboxImages.length > 1" class="absolute -bottom-16 left-1/2 transform -translate-x-1/2 text-center">
          <div class="text-white text-sm font-medium mb-2">
            {{ currentImageIndex + 1 }} / {{ lightboxImages.length }}
          </div>
          <div class="text-white/70 text-xs">
            {{ lightboxImages[currentImageIndex]?.image }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, nextTick } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import axios from 'axios'


import {
  Search, Filter, Phone, MapPin, User, Check, X, ExternalLink,
  FileText, ImageIcon, File, Clock, CheckCircle, XCircle, Edit2, DollarSign,
  Package, Star
} from 'lucide-vue-next'


const { commandes = [] } = usePage().props

const commands = ref(commandes)
console.log(commands.value);

const searchTerm = ref('')
const statusFilter = ref('all')

const editingPrice = ref(null)
const editingNote = ref(null)
const tempPrice = ref('')
const tempNote = ref('')

const lightboxOpen = ref(false)
const lightboxImages = ref([])
const currentImageIndex = ref(0)

const statusFilters = [
  { value: 'all', label: 'All Orders' },
  { value: 'pending', label: 'Pending' },
  { value: 'done', label: 'Completed' },
  { value: 'cancelled', label: 'Cancelled' },
]

const filteredCommands = computed(() => {
  return commands.value.filter(cmd => {
    const matchesSearch =
      cmd.name.toLowerCase().includes(searchTerm.value.toLowerCase()) ||
      cmd.ville.toLowerCase().includes(searchTerm.value.toLowerCase()) ||
      cmd.telephone.includes(searchTerm.value)

    const matchesStatus = statusFilter.value === 'all' || cmd.status === statusFilter.value

    return matchesSearch && matchesStatus
  })
})
import LayoutAdmin from '@/Layout/LayoutAdmin.vue' 

defineOptions({
    layout:LayoutAdmin
})

const pendingCount = computed(() =>
  commands.value.filter(cmd => cmd.status === 'pending').length
)

const completedCount = computed(() =>
  commands.value.filter(cmd => cmd.status === 'done').length
)

const cancelledCount = computed(() =>
  commands.value.filter(cmd => cmd.status === 'cancelled').length
)

const packPlusCount = computed(() =>
  commands.value.filter(cmd => cmd.pack === 'plus').length
)

const markDone = async (id) => {
  const command = commands.value.find(cmd => cmd.id === id)
  if (command) {
    command.status = 'done'
    try {
      await router.post(`/admin/commandes/${id}/markDone`)
    } catch (error) {
      console.error(error)
    }
  }
}

const cancelCommand = async (id) => {
  const command = commands.value.find(cmd => cmd.id === id)
  if (command) {
    command.status = 'cancelled'
    try {
      await router.post(`/admin/commandes/${id}/cancel`)
    } catch (error) {
      console.error(error)
    }
  }
}

const getImageFiles = (items) => {
  if (!items) return []
  return items.filter(item => {
    const ext = item.image?.split('.').pop()?.toLowerCase()
    return ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'].includes(ext || '')
  })
}

const getNonImageFiles = (items) => {
  if (!items) return []
  return items.filter(item => {
    const ext = item.image?.split('.').pop()?.toLowerCase()
    return !['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'].includes(ext || '')
  })
}

const openLightbox = (images, index = 0) => {
  if (images.length === 0) return
  lightboxImages.value = images
  currentImageIndex.value = index
  lightboxOpen.value = true
  document.body.style.overflow = 'hidden'
}

const closeLightbox = () => {
  lightboxOpen.value = false
  lightboxImages.value = []
  currentImageIndex.value = 0
  document.body.style.overflow = 'auto'
}

const nextImage = () => {
  if (lightboxImages.value.length > 1) {
    currentImageIndex.value = (currentImageIndex.value + 1) % lightboxImages.value.length
  }
}

const previousImage = () => {
  if (lightboxImages.value.length > 1) {
    currentImageIndex.value = currentImageIndex.value === 0
      ? lightboxImages.value.length - 1
      : currentImageIndex.value - 1
  }
}

const getFileIcon = (filename) => {
  if (!filename) return File
  const ext = filename.split('.').pop()?.toLowerCase()
  if (['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'].includes(ext || '')) {
    return ImageIcon
  }
  if (ext === 'pdf') {
    return FileText
  }
  return File
}

const getFileType = (filename) => {
  if (!filename) return ''
  const ext = filename.split('.').pop()?.toLowerCase()
  if (['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'].includes(ext || '')) return 'Image'
  if (ext === 'pdf') return 'PDF'
  return ext?.toUpperCase() || 'File'
}

const startEditingPrice = async (commandId, currentPrice) => {
  editingPrice.value = commandId
  tempPrice.value = currentPrice || ''
  await nextTick()
  const input = document.querySelector('input[ref="priceInput"]')
  if (input) input.focus()
}


const savePrice = async (commandId) => { 
  try {
    const command = commands.value.find(cmd => cmd.id === commandId)
    if (command) {
      command.price = tempPrice.value
      await axios.post(`/admin/commandes/${commandId}/updatePrice`, {
        price: tempPrice.value
      })
    }
  } catch (error) {
    console.error('Error updating price:', error)
  } finally {
    editingPrice.value = null
    tempPrice.value = ''
  }
}


const cancelEditingPrice = () => {
  editingPrice.value = null
  tempPrice.value = ''
}

const startEditingNote = async (commandId, currentNote) => {
  editingNote.value = commandId
  tempNote.value = currentNote || ''
  await nextTick()
  const textarea = document.querySelector('textarea[ref="noteInput"]')
  if (textarea) textarea.focus()
}

const saveNote = async (commandId) => {
  try {
    const command = commands.value.find(cmd => cmd.id === commandId)
    if (command) {
      command.note = tempNote.value
      await axios.post(`/admin/commandes/${commandId}/updateNote`, {
        note: tempNote.value
      })
    }
  } catch (error) {
    console.error('Error updating note:', error)
  } finally {
    editingNote.value = null
    tempNote.value = ''
  }
}

const cancelEditingNote = () => {
  editingNote.value = null
  tempNote.value = ''
}

const getStatusClasses = (status) => {
  switch (status) {
    case 'done':
      return 'bg-emerald-100 text-emerald-800'
    case 'cancelled':
      return 'bg-red-100 text-red-800'
    default:
      return 'bg-amber-100 text-amber-800'
  }
}

const getPackLabel = (packType) => {
  if (packType === 'plus') return 'Pack Plus'
  if (packType === 'eco') return 'Eco Pack'

}

const getStatusLabel = (status) => {
  switch (status) {
    case 'pending': return 'Pending'
    case 'done': return 'Completed'
    case 'cancelled': return 'Cancelled'
    default: return status
  }
}
</script>
