<template>
  <div class="min-h-screen bg-gradient-to-br from-emerald-50 via-teal-50/30 to-cyan-50/20">
    <!-- Modern Header -->
    <header class="bg-white/90 backdrop-blur-xl border-b border-emerald-200/60 sticky top-0 z-40 shadow-lg shadow-emerald-500/5">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-24 py-4">
          <div class="flex items-center space-x-6">
            <div class="flex items-center space-x-4">
              <div class="w-16 h-16 bg-gradient-to-br from-emerald-600 to-teal-700 rounded-3xl flex items-center justify-center shadow-xl shadow-emerald-500/30">
                <FileText class="w-8 h-8 text-white" />
              </div>
              <div>
                <h1 class="text-3xl font-black bg-gradient-to-r from-emerald-900 to-teal-800 bg-clip-text text-transparent">Orders Hub</h1>
                <p class="text-sm text-emerald-600 font-semibold">Advanced order management system</p>
              </div>
            </div>
          </div>
          <div class="flex items-center space-x-4">
            <div class="bg-gradient-to-r from-emerald-600 to-teal-700 text-white px-6 py-3 rounded-2xl text-sm font-bold shadow-xl shadow-emerald-500/30">
              {{ filteredCommands.length }} order{{ filteredCommands.length !== 1 ? 's' : '' }}
            </div>
          </div>
        </div>
      </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
      <!-- Enhanced Metrics Cards with New Design -->
      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6 mb-10">
        <div class="group bg-white/80 backdrop-blur-sm rounded-3xl p-8 border border-emerald-200/60 hover:shadow-2xl hover:shadow-emerald-500/15 transition-all duration-300 hover:-translate-y-2">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-xs font-black text-emerald-600 uppercase tracking-widest mb-3">Total Orders</p>
              <p class="text-4xl font-black text-gray-900">{{ commands.length }}</p>
              <p class="text-xs text-emerald-500 mt-2 font-semibold">All time</p>
            </div>
            <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-3xl flex items-center justify-center shadow-xl shadow-emerald-500/30 group-hover:scale-110 transition-transform duration-300">
              <FileText class="w-8 h-8 text-white" />
            </div>
          </div>
        </div>

        <div class="group bg-white/80 backdrop-blur-sm rounded-3xl p-8 border border-amber-200/60 hover:shadow-2xl hover:shadow-amber-500/15 transition-all duration-300 hover:-translate-y-2">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-xs font-black text-amber-600 uppercase tracking-widest mb-3">Pending</p>
              <p class="text-4xl font-black text-amber-700">{{ pendingCount }}</p>
              <p class="text-xs text-amber-500 mt-2 font-semibold">Awaiting action</p>
            </div>
            <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-orange-600 rounded-3xl flex items-center justify-center shadow-xl shadow-amber-500/30 group-hover:scale-110 transition-transform duration-300">
              <Clock class="w-8 h-8 text-white" />
            </div>
          </div>
        </div>

        <div class="group bg-white/80 backdrop-blur-sm rounded-3xl p-8 border border-green-200/60 hover:shadow-2xl hover:shadow-green-500/15 transition-all duration-300 hover:-translate-y-2">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-xs font-black text-green-600 uppercase tracking-widest mb-3">Completed</p>
              <p class="text-4xl font-black text-green-700">{{ completedCount }}</p>
              <p class="text-xs text-green-500 mt-2 font-semibold">Successfully done</p>
            </div>
            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-3xl flex items-center justify-center shadow-xl shadow-green-500/30 group-hover:scale-110 transition-transform duration-300">
              <CheckCircle class="w-8 h-8 text-white" />
            </div>
          </div>
        </div>

        <div class="group bg-white/80 backdrop-blur-sm rounded-3xl p-8 border border-red-200/60 hover:shadow-2xl hover:shadow-red-500/15 transition-all duration-300 hover:-translate-y-2">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-xs font-black text-red-600 uppercase tracking-widest mb-3">Cancelled</p>
              <p class="text-4xl font-black text-red-700">{{ cancelledCount }}</p>
              <p class="text-xs text-red-500 mt-2 font-semibold">Terminated</p>
            </div>
            <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-rose-600 rounded-3xl flex items-center justify-center shadow-xl shadow-red-500/30 group-hover:scale-110 transition-transform duration-300">
              <XCircle class="w-8 h-8 text-white" />
            </div>
          </div>
        </div>

        <!-- Added new Pack Statistics card -->
        <div class="group bg-white/80 backdrop-blur-sm rounded-3xl p-8 border border-purple-200/60 hover:shadow-2xl hover:shadow-purple-500/15 transition-all duration-300 hover:-translate-y-2">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-xs font-black text-purple-600 uppercase tracking-widest mb-3">Pack Plus</p>
              <p class="text-4xl font-black text-purple-700">{{ packPlusCount }}</p>
              <p class="text-xs text-purple-500 mt-2 font-semibold">Premium orders</p>
            </div>
            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-violet-600 rounded-3xl flex items-center justify-center shadow-xl shadow-purple-500/30 group-hover:scale-110 transition-transform duration-300">
              <Star class="w-8 h-8 text-white" />
            </div>
          </div>
        </div>
      </div>

      <!-- Enhanced Filters with New Design -->
      <div class="bg-white/80 backdrop-blur-sm rounded-3xl border border-emerald-200/60 p-8 mb-10 shadow-xl shadow-emerald-500/5">
        <div class="flex flex-col lg:flex-row gap-8">
          <div class="relative flex-1">
            <Search class="absolute left-6 top-1/2 transform -translate-y-1/2 text-emerald-400 w-6 h-6" />
            <input
              v-model="searchTerm"
              type="text"
              placeholder="Search by name, city, or phone..."
              class="w-full pl-16 pr-6 py-5 border border-emerald-200/60 rounded-2xl focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-500/50 transition-all duration-200 bg-white/70 backdrop-blur-sm text-gray-900 placeholder-emerald-400 font-semibold text-lg"
            />
          </div>
          <div class="flex gap-4 flex-wrap">
            <button
              v-for="filter in statusFilters"
              :key="filter.value"
              @click="statusFilter = filter.value"
              :class="[
                'px-8 py-5 rounded-2xl font-bold text-sm transition-all duration-200 flex items-center gap-4 shadow-lg',
                statusFilter === filter.value
                  ? 'bg-gradient-to-r from-emerald-600 to-teal-700 text-white shadow-xl shadow-emerald-500/30 scale-105'
                  : 'bg-white/70 text-emerald-700 hover:bg-white/90 hover:shadow-xl border border-emerald-200/60'
              ]"
            >
              <component :is="filter.icon" class="w-5 h-5" />
              {{ filter.label }}
            </button>
          </div>
        </div>
      </div>

      <!-- Enhanced Orders Table/Cards with New Design -->
      <div class="bg-white/80 backdrop-blur-sm rounded-3xl border border-emerald-200/60 overflow-hidden shadow-2xl shadow-emerald-500/10">
        <!-- Desktop Table -->
        <div class="hidden lg:block">
          <div class="overflow-x-auto">
            <table class="w-full">
              <thead class="bg-gradient-to-r from-emerald-50/80 to-teal-50/80 border-b border-emerald-200/60">
                <tr>
                  <th class="px-10 py-8 text-left text-xs font-black text-emerald-700 uppercase tracking-widest">
                    Customer
                  </th>
                  <th class="px-10 py-8 text-left text-xs font-black text-emerald-700 uppercase tracking-widest">
                    Contact
                  </th>
                  <th class="px-10 py-8 text-left text-xs font-black text-emerald-700 uppercase tracking-widest">
                    Price
                  </th>
                  <!-- Added Pack column -->
                  <th class="px-10 py-8 text-left text-xs font-black text-emerald-700 uppercase tracking-widest">
                    Pack Type
                  </th>
                  <th class="px-10 py-8 text-left text-xs font-black text-emerald-700 uppercase tracking-widest">
                    Files
                  </th>
                  <th class="px-10 py-8 text-left text-xs font-black text-emerald-700 uppercase tracking-widest">
                    Notes
                  </th>
                  <th class="px-10 py-8 text-left text-xs font-black text-emerald-700 uppercase tracking-widest">
                    Status
                  </th>
                  <th class="px-10 py-8 text-center text-xs font-black text-emerald-700 uppercase tracking-widest">
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-emerald-200/60">
                <tr
                  v-for="command in filteredCommands"
                  :key="command.id"
                  class="hover:bg-emerald-50/30 transition-all duration-200 group"
                >
                  <td class="px-10 py-8">
                    <div class="flex items-center">
                      <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-3xl flex items-center justify-center mr-6 shadow-xl shadow-emerald-500/30 group-hover:scale-105 transition-transform duration-200">
                        <User class="w-7 h-7 text-white" />
                      </div>
                      <div class="font-black text-gray-900 text-xl">{{ command.name }}</div>
                    </div>
                  </td>
                  <td class="px-10 py-8">
                    <div class="space-y-3">
                      <div class="flex items-center gap-4 text-sm text-gray-600 font-semibold">
                        <div class="w-10 h-10 bg-blue-50 rounded-2xl flex items-center justify-center">
                          <Phone class="w-5 h-5 text-blue-600" />
                        </div>
                        {{ command.telephone }}
                      </div>
                      <div class="flex items-center gap-4 text-sm text-gray-600 font-semibold">
                        <div class="w-10 h-10 bg-green-50 rounded-2xl flex items-center justify-center">
                          <MapPin class="w-5 h-5 text-green-600" />
                        </div>
                        {{ command.ville }}
                      </div>
                    </div>
                  </td>
                  <td class="px-10 py-8">
                    <div class="flex items-center gap-3">
                      <div class="w-10 h-10 bg-emerald-50 rounded-2xl flex items-center justify-center">
                        <DollarSign class="w-5 h-5 text-emerald-600" />
                      </div>
                      <div v-if="editingPrice !== command.id" class="flex items-center gap-3">
                        <span class="font-bold text-gray-900 text-lg">
                          {{ command.price ? `$${command.price}` : 'Not set' }}
                        </span>
                        <button
                          @click="startEditingPrice(command.id, command.price)"
                          class="p-2 text-gray-400 hover:text-emerald-600 transition-colors rounded-xl hover:bg-emerald-50"
                        >
                          <Edit2 class="w-5 h-5" />
                        </button>
                      </div>
                      <div v-else class="flex items-center gap-3">
                        <input
                          v-model="tempPrice"
                          @keyup.enter="savePrice(command.id)"
                          @keyup.escape="cancelEditingPrice"
                          type="number"
                          step="0.01"
                          placeholder="0.00"
                          class="w-28 px-3 py-2 text-sm border border-emerald-300 rounded-xl focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500/50"
                          ref="priceInput"
                        />
                        <button
                          @click="savePrice(command.id)"
                          class="p-2 text-green-600 hover:text-green-700 transition-colors rounded-xl bg-green-50"
                        >
                          <Check class="w-5 h-5" />
                        </button>
                        <button
                          @click="cancelEditingPrice"
                          class="p-2 text-red-600 hover:text-red-700 transition-colors rounded-xl bg-red-50"
                        >
                          <X class="w-5 h-5" />
                        </button>
                      </div>
                    </div>
                  </td>
                  <!-- Added Pack Type column with editing functionality -->
                  <td class="px-10 py-8">
                    <div class="flex items-center gap-3">
                      <div class="w-10 h-10 bg-purple-50 rounded-2xl flex items-center justify-center">
                        <Package class="w-5 h-5 text-purple-600" />
                      </div>
                      <div v-if="editingPack !== command.id" class="flex items-center gap-3">
                        <span :class="getPackClasses(command.pack_type)">
                          {{ getPackLabel(command.pack_type) }}
                        </span>
                        <button
                          @click="startEditingPack(command.id, command.pack_type)"
                          class="p-2 text-gray-400 hover:text-purple-600 transition-colors rounded-xl hover:bg-purple-50"
                        >
                          <Edit2 class="w-5 h-5" />
                        </button>
                      </div>
                      <div v-else class="flex items-center gap-3">
                        <select
                          v-model="tempPack"
                          @keyup.enter="savePack(command.id)"
                          @keyup.escape="cancelEditingPack"
                          class="px-3 py-2 text-sm border border-purple-300 rounded-xl focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500/50"
                          ref="packSelect"
                        >
                          <option value="eco_pack">Eco Pack</option>
                          <option value="pack_plus">Pack Plus</option>
                        </select>
                        <button
                          @click="savePack(command.id)"
                          class="p-2 text-green-600 hover:text-green-700 transition-colors rounded-xl bg-green-50"
                        >
                          <Check class="w-5 h-5" />
                        </button>
                        <button
                          @click="cancelEditingPack"
                          class="p-2 text-red-600 hover:text-red-700 transition-colors rounded-xl bg-red-50"
                        >
                          <X class="w-5 h-5" />
                        </button>
                      </div>
                    </div>
                  </td>
                  <td class="px-10 py-8">
                    <div class="flex items-center gap-4">
                      <div v-if="command.items && command.items.length > 0" class="flex items-center gap-3">
                        <button
                          @click="openLightbox(getImageFiles(command.items), 0)"
                          v-if="getImageFiles(command.items).length > 0"
                          class="inline-flex items-center gap-3 px-5 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-2xl text-sm font-bold hover:from-emerald-600 hover:to-teal-700 transition-all duration-200 shadow-xl shadow-emerald-500/30 hover:scale-105 cursor-pointer"
                        >
                          <ImageIcon class="w-5 h-5" />
                          +{{ getImageFiles(command.items).length }}
                        </button>

                        <div v-if="getNonImageFiles(command.items).length > 0" class="flex flex-wrap gap-2">
                          <a
                            v-for="item in getNonImageFiles(command.items)"
                            :key="item.id"
                            :href="`/storage/${item.image}`"
                            target="_blank"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-50 to-cyan-50 text-blue-700 rounded-2xl text-xs font-bold hover:from-blue-100 hover:to-cyan-100 transition-all duration-200 shadow-lg border border-blue-200/50"
                          >
                            <component :is="getFileIcon(item.image)" class="w-4 h-4" />
                            {{ getFileType(item.image) }}
                            <ExternalLink class="w-3 h-3" />
                          </a>
                        </div>
                      </div>
                      <div v-else class="text-sm text-gray-400 font-semibold">
                        No files
                      </div>
                    </div>
                  </td>
                  <td class="px-10 py-8">
                    <div class="flex items-start gap-4">
                      <div class="w-10 h-10 bg-blue-50 rounded-2xl flex items-center justify-center">
                        <FileText class="w-5 h-5 text-blue-600" />
                      </div>
                      <div v-if="editingNote !== command.id" class="flex items-start gap-3 flex-1">
                        <p class="text-sm text-gray-700 max-w-xs truncate font-medium">
                          {{ command.note || 'No notes' }}
                        </p>
                        <button
                          @click="startEditingNote(command.id, command.note)"
                          class="p-2 text-gray-400 hover:text-blue-600 transition-colors flex-shrink-0 rounded-xl hover:bg-blue-50"
                        >
                          <Edit2 class="w-5 h-5" />
                        </button>
                      </div>
                      <div v-else class="flex items-start gap-3 flex-1">
                        <textarea
                          v-model="tempNote"
                          @keyup.ctrl.enter="saveNote(command.id)"
                          @keyup.escape="cancelEditingNote"
                          placeholder="Add a note..."
                          rows="2"
                          class="flex-1 px-3 py-2 text-sm border border-blue-300 rounded-xl focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 resize-none"
                          ref="noteInput"
                        ></textarea>
                        <div class="flex flex-col gap-2">
                          <button
                            @click="saveNote(command.id)"
                            class="p-2 text-green-600 hover:text-green-700 transition-colors rounded-xl bg-green-50"
                          >
                            <Check class="w-5 h-5" />
                          </button>
                          <button
                            @click="cancelEditingNote"
                            class="p-2 text-red-600 hover:text-red-700 transition-colors rounded-xl bg-red-50"
                          >
                            <X class="w-5 h-5" />
                          </button>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="px-10 py-8">
                    <span :class="getEnhancedStatusClasses(command.status)">
                      {{ getStatusLabel(command.status) }}
                    </span>
                  </td>
                  <td class="px-10 py-8">
                    <div class="flex justify-center gap-4" v-if="command.status === 'pending'">
                      <button
                        @click="markDone(command.id)"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-700 text-white text-sm font-bold rounded-2xl hover:from-green-700 hover:to-emerald-800 transition-all duration-200 shadow-xl shadow-green-500/30 hover:scale-105"
                      >
                        <Check class="w-5 h-5 mr-2" />
                        Complete
                      </button>
                      <button
                        @click="cancelCommand(command.id)"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-600 to-rose-700 text-white text-sm font-bold rounded-2xl hover:from-red-700 hover:to-rose-800 transition-all duration-200 shadow-xl shadow-red-500/30 hover:scale-105"
                      >
                        <X class="w-5 h-5 mr-2" />
                        Cancel
                      </button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Enhanced Mobile Cards with New Design -->
        <div class="lg:hidden p-8 space-y-8">
          <div
            v-for="command in filteredCommands"
            :key="command.id"
            class="bg-white/90 backdrop-blur-sm border border-emerald-200/60 rounded-3xl p-8 hover:shadow-2xl hover:shadow-emerald-500/15 transition-all duration-300 hover:-translate-y-1"
          >
            <div class="flex justify-between items-start mb-8">
              <div class="flex items-center">
                <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-3xl flex items-center justify-center mr-6 shadow-xl shadow-emerald-500/30">
                  <User class="w-8 h-8 text-white" />
                </div>
                <div>
                  <h3 class="font-black text-gray-900 text-xl">{{ command.name }}</h3>
                  <span :class="getEnhancedStatusClasses(command.status)">
                    {{ getStatusLabel(command.status) }}
                  </span>
                </div>
              </div>
            </div>

            <div class="space-y-6 mb-8">
              <div class="flex items-center gap-4 text-sm text-gray-600 font-semibold">
                <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center">
                  <Phone class="w-6 h-6 text-blue-600" />
                </div>
                {{ command.telephone }}
              </div>
              <div class="flex items-center gap-4 text-sm text-gray-600 font-semibold">
                <div class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center">
                  <MapPin class="w-6 h-6 text-green-600" />
                </div>
                {{ command.ville }}
              </div>
              <div class="flex items-center gap-4 text-sm text-gray-600 font-semibold">
                <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center">
                  <DollarSign class="w-6 h-6 text-emerald-600" />
                </div>
                <div v-if="editingPrice !== command.id" class="flex items-center gap-3 flex-1">
                  <span class="font-bold text-gray-900 text-lg">
                    {{ command.price ? `$${command.price}` : 'Price not set' }}
                  </span>
                  <button
                    @click="startEditingPrice(command.id, command.price)"
                    class="p-3 text-gray-400 hover:text-emerald-600 transition-colors bg-white rounded-2xl border border-gray-200 shadow-lg"
                  >
                    <Edit2 class="w-5 h-5" />
                  </button>
                </div>
                <div v-else class="flex items-center gap-3 flex-1">
                  <input
                    v-model="tempPrice"
                    @keyup.enter="savePrice(command.id)"
                    @keyup.escape="cancelEditingPrice"
                    type="number"
                    step="0.01"
                    placeholder="0.00"
                    class="flex-1 px-4 py-3 text-sm border border-emerald-300 rounded-2xl focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500/50"
                  />
                  <button
                    @click="savePrice(command.id)"
                    class="p-3 text-green-600 hover:text-green-700 transition-colors bg-green-50 rounded-2xl shadow-lg"
                  >
                    <Check class="w-5 h-5" />
                  </button>
                  <button
                    @click="cancelEditingPrice"
                    class="p-3 text-red-600 hover:text-red-700 transition-colors bg-red-50 rounded-2xl shadow-lg"
                  >
                    <X class="w-5 h-5" />
                  </button>
                </div>
              </div>
              <!-- Added Pack Type section for mobile -->
              <div class="flex items-center gap-4 text-sm text-gray-600 font-semibold">
                <div class="w-12 h-12 bg-purple-50 rounded-2xl flex items-center justify-center">
                  <Package class="w-6 h-6 text-purple-600" />
                </div>
                <div v-if="editingPack !== command.id" class="flex items-center gap-3 flex-1">
                  <span :class="getPackClasses(command.pack_type)">
                    {{ getPackLabel(command.pack_type) }}
                  </span>
                  <button
                    @click="startEditingPack(command.id, command.pack_type)"
                    class="p-3 text-gray-400 hover:text-purple-600 transition-colors bg-white rounded-2xl border border-gray-200 shadow-lg"
                  >
                    <Edit2 class="w-5 h-5" />
                  </button>
                </div>
                <div v-else class="flex items-center gap-3 flex-1">
                  <select
                    v-model="tempPack"
                    @keyup.enter="savePack(command.id)"
                    @keyup.escape="cancelEditingPack"
                    class="flex-1 px-4 py-3 text-sm border border-purple-300 rounded-2xl focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500/50"
                  >
                    <option value="eco_pack">Eco Pack</option>
                    <option value="pack_plus">Pack Plus</option>
                  </select>
                  <button
                    @click="savePack(command.id)"
                    class="p-3 text-green-600 hover:text-green-700 transition-colors bg-green-50 rounded-2xl shadow-lg"
                  >
                    <Check class="w-5 h-5" />
                  </button>
                  <button
                    @click="cancelEditingPack"
                    class="p-3 text-red-600 hover:text-red-700 transition-colors bg-red-50 rounded-2xl shadow-lg"
                  >
                    <X class="w-5 h-5" />
                  </button>
                </div>
              </div>

              <div class="mb-8">
                <h4 class="text-sm font-black text-gray-700 mb-4 flex items-center gap-3">
                  <div class="w-8 h-8 bg-blue-100 rounded-2xl flex items-center justify-center">
                    <FileText class="w-5 h-5 text-blue-600" />
                  </div>
                  Notes:
                </h4>
                <div v-if="editingNote !== command.id" class="flex items-start gap-4">
                  <p class="text-sm text-gray-700 flex-1 bg-gray-50 rounded-2xl p-4 min-h-[3rem] font-medium">
                    {{ command.note || 'No notes added yet' }}
                  </p>
                  <button
                    @click="startEditingNote(command.id, command.note)"
                    class="p-3 text-gray-400 hover:text-blue-600 transition-colors bg-white rounded-2xl border border-gray-200 shadow-lg"
                  >
                    <Edit2 class="w-5 h-5" />
                  </button>
                </div>
                <div v-else class="flex items-start gap-4">
                  <textarea
                    v-model="tempNote"
                    @keyup.ctrl.enter="saveNote(command.id)"
                    @keyup.escape="cancelEditingNote"
                    placeholder="Add a note..."
                    rows="3"
                    class="flex-1 px-4 py-3 text-sm border border-blue-300 rounded-2xl focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 resize-none"
                  ></textarea>
                  <div class="flex flex-col gap-3">
                    <button
                      @click="saveNote(command.id)"
                      class="p-3 text-green-600 hover:text-green-700 transition-colors bg-green-50 rounded-2xl shadow-lg"
                    >
                      <Check class="w-5 h-5" />
                    </button>
                    <button
                      @click="cancelEditingNote"
                      class="p-3 text-red-600 hover:text-red-700 transition-colors bg-red-50 rounded-2xl shadow-lg"
                    >
                      <X class="w-5 h-5" />
                    </button>
                  </div>
                </div>
              </div>
              <div class="mb-8">
                <h4 class="text-sm font-black text-gray-700 mb-4 flex items-center gap-3">
                  <div class="w-8 h-8 bg-gray-100 rounded-2xl flex items-center justify-center">
                    <FileText class="w-5 h-5 text-gray-600" />
                  </div>
                  Files:
                </h4>
                <div v-if="command.items && command.items.length > 0" class="flex flex-wrap gap-3">
                  <button
                    v-if="getImageFiles(command.items).length > 0"
                    @click="openLightbox(getImageFiles(command.items), 0)"
                    class="inline-flex items-center gap-3 px-6 py-4 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-2xl text-sm font-bold hover:from-emerald-600 hover:to-teal-700 transition-all duration-200 shadow-xl shadow-emerald-500/30"
                  >
                    <ImageIcon class="w-6 h-6" />
                    {{ getImageFiles(command.items).length }} image{{ getImageFiles(command.items).length !== 1 ? 's' : '' }}
                  </button>
                  <a
                    v-for="item in getNonImageFiles(command.items)"
                    :key="item.id"
                    :href="`/storage/${item.image}`"
                    target="_blank"
                    class="inline-flex items-center gap-2 px-4 py-3 bg-gradient-to-r from-blue-50 to-cyan-50 text-blue-700 rounded-2xl text-xs font-bold hover:from-blue-100 hover:to-cyan-100 transition-all duration-200 shadow-lg border border-blue-200/50"
                  >
                    <component :is="getFileIcon(item.image)" class="w-5 h-5" />
                    {{ getFileType(item.image) }}
                    <ExternalLink class="w-4 h-4" />
                  </a>
                </div>
                <div v-else class="text-sm text-gray-400 font-semibold">
                  No files attached
                </div>
              </div>
              <div v-if="command.status === 'pending'" class="flex gap-4">
                <button
                  @click="markDone(command.id)"
                  class="flex-1 inline-flex items-center justify-center px-6 py-4 bg-gradient-to-r from-green-600 to-emerald-700 text-white text-sm font-bold rounded-2xl hover:from-green-700 hover:to-emerald-800 transition-all duration-200 shadow-xl shadow-green-500/30"
                >
                  <Check class="w-5 h-5 mr-2" />
                  Complete
                </button>
                <button
                  @click="cancelCommand(command.id)"
                  class="flex-1 inline-flex items-center justify-center px-6 py-4 bg-gradient-to-r from-red-600 to-rose-700 text-white text-sm font-bold rounded-2xl hover:from-red-700 hover:to-rose-800 transition-all duration-200 shadow-xl shadow-red-500/30"
                >
                  <X class="w-5 h-5 mr-2" />
                  Cancel
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Enhanced Empty State -->
        <div v-if="filteredCommands.length === 0" class="p-20 text-center">
          <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-xl">
            <Search class="w-12 h-12 text-gray-400" />
          </div>
          <h3 class="text-2xl font-black text-gray-900 mb-4">No orders found</h3>
          <p class="text-gray-600 font-semibold max-w-md mx-auto text-lg">
            {{ searchTerm || statusFilter !== 'all'
              ? 'Try adjusting your search criteria or filters to find what you\'re looking for.'
              : 'No orders available at the moment. New orders will appear here.' }}
          </p>
        </div>
      </div>
    </div>

    <!-- Enhanced Image Lightbox Modal -->
    <div
      v-if="lightboxOpen"
      @click="closeLightbox"
      class="fixed inset-0 bg-black/95 backdrop-blur-sm z-50 flex items-center justify-center p-4"
    >
      <div class="relative max-w-4xl max-h-full w-full">
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
              class="max-w-full max-h-[80vh] object-contain rounded-2xl shadow-2xl"
              @click.stop
            />
          </div>

          <div v-if="lightboxImages.length > 1" class="hidden md:block">
            <button
              @click.stop="previousImage"
              class="absolute left-4 top-1/2 transform -translate-y-1/2 p-3 bg-black/50 text-white rounded-full hover:bg-black/70 transition-all duration-200 hover:scale-110"
            >
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
              </svg>
            </button>

            <button
              @click.stop="nextImage"
              class="absolute right-4 top-1/2 transform -translate-y-1/2 p-3 bg-black/50 text-white rounded-full hover:bg-black/70 transition-all duration-200 hover:scale-110"
            >
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
            </button>
          </div>
        </div>

        <div v-if="lightboxImages.length > 1" class="mt-6 md:hidden">
          <div class="flex gap-2 overflow-x-auto pb-2 px-4 scrollbar-hide justify-center">
            <button
              v-for="(image, index) in lightboxImages"
              :key="image.id"
              @click.stop="currentImageIndex = index"
              :class="[
                'flex-shrink-0 w-16 h-16 rounded-lg overflow-hidden border-2 transition-all duration-200',
                currentImageIndex === index
                  ? 'border-emerald-500 scale-110 shadow-lg shadow-emerald-500/50'
                  : 'border-white/30 hover:border-white/60'
              ]"
            >
              <img
                :src="`/storage/${image.image}`"
                :alt="image.image"
                class="w-full h-full object-cover"
              />
            </button>
          </div>
        </div>

        <div class="absolute -bottom-16 left-1/2 transform -translate-x-1/2 text-center">
          <div v-if="lightboxImages.length > 1" class="text-white text-sm font-medium mb-2">
            {{ currentImageIndex + 1 }} / {{ lightboxImages.length }}
          </div>
          <div class="text-white/70 text-xs">
            {{ lightboxImages[currentImageIndex]?.image }}
          </div>
        </div>

        <div class="md:hidden absolute bottom-4 left-1/2 transform -translate-x-1/2 text-white/60 text-xs text-center">
          <p>Tap thumbnails to navigate • Tap outside to close</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, nextTick } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import {
  Search, Filter, Phone, MapPin, User, Check, X, ExternalLink,
  FileText, ImageIcon, File, Clock, CheckCircle, XCircle, Edit2, DollarSign,
  Package, Star
} from 'lucide-vue-next'

const { commandes = [] } = usePage().props
const commands = ref(commandes)

const searchTerm = ref('')
const statusFilter = ref('all')

const editingPrice = ref(null)
const editingNote = ref(null)
const editingPack = ref(null) // Added pack editing state
const tempPrice = ref('')
const tempNote = ref('')
const tempPack = ref('') // Added temp pack state

// Lightbox state
const lightboxOpen = ref(false)
const lightboxImages = ref([])
const currentImageIndex = ref(0)

const statusFilters = [
  { value: 'all', label: 'All Orders', icon: Filter },
  { value: 'pending', label: 'Pending', icon: Clock },
  { value: 'done', label: 'Completed', icon: CheckCircle },
  { value: 'cancelled', label: 'Cancelled', icon: XCircle },
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
  commands.value.filter(cmd => cmd.pack_type === 'pack_plus').length
)

const markDone = async (id) => {
  const command = commands.value.find(cmd => cmd.id === id)
  if (command) {
    command.status = 'done'
    try {
      await router.post(`/commandes/${id}/markDone`)
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
      await router.post(`/commandes/${id}/cancel`)
    } catch (error) {
      console.error(error)
    }
  }
}

// Enhanced file handling methods
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

// Lightbox methods
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

const getEnhancedStatusClasses = (status) => {
  const baseClasses = 'inline-flex items-center px-4 py-2 rounded-2xl text-xs font-black shadow-lg'
  switch (status) {
    case 'done':
      return `${baseClasses} bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border border-green-200/50`
    case 'cancelled':
      return `${baseClasses} bg-gradient-to-r from-red-100 to-rose-100 text-red-800 border border-red-200/50`
    default:
      return `${baseClasses} bg-gradient-to-r from-amber-100 to-orange-100 text-amber-800 border border-amber-200/50`
  }
}

const getPackClasses = (packType) => {
  const baseClasses = 'inline-flex items-center px-4 py-2 rounded-2xl text-xs font-black shadow-lg'
  switch (packType) {
    case 'pack_plus':
      return `${baseClasses} bg-gradient-to-r from-purple-100 to-violet-100 text-purple-800 border border-purple-200/50`
    case 'eco_pack':
      return `${baseClasses} bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border border-green-200/50`
    default:
      return `${baseClasses} bg-gradient-to-r from-gray-100 to-slate-100 text-gray-800 border border-gray-200/50`
  }
}

const getPackLabel = (packType) => {
  switch (packType) {
    case 'pack_plus': return 'Pack Plus'
    case 'eco_pack': return 'Eco Pack'
    default: return 'Not Set'
  }
}

const getStatusLabel = (status) => {
  switch (status) {
    case 'pending': return 'Pending'
    case 'done': return 'Completed'
    case 'cancelled': return 'Cancelled'
    default: return status
  }
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
      await router.post(`/commandes/${commandId}/updatePrice`, {
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

const startEditingPack = async (commandId, currentPack) => {
  editingPack.value = commandId
  tempPack.value = currentPack || 'eco_pack'
  await nextTick()
  const select = document.querySelector('select[ref="packSelect"]')
  if (select) select.focus()
}

const savePack = async (commandId) => {
  try {
    const command = commands.value.find(cmd => cmd.id === commandId)
    if (command) {
      command.pack_type = tempPack.value
      await router.post(`/commandes/${commandId}/updatePack`, {
        pack_type: tempPack.value
      })
    }
  } catch (error) {
    console.error('Error updating pack:', error)
  } finally {
    editingPack.value = null
    tempPack.value = ''
  }
}

const cancelEditingPack = () => {
  editingPack.value = null
  tempPack.value = ''
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
      await router.post(`/commandes/${commandId}/updateNote`, {
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
</script>

<style scoped>
.scrollbar-hide {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
.scrollbar-hide::-webkit-scrollbar {
  display: none;
}
</style>
