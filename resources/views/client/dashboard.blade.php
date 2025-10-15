@extends('layouts.clients')

@section('title', 'Tableau de bord')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 fade-in">
  <!-- Carte 1 -->
  <div class="bg-white border border-gray-200 rounded-xl shadow-md hover:shadow-xl transition duration-300">
    <div class="flex items-center gap-3 px-5 py-4 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-t-xl">
      <i class="bi bi-bar-chart text-xl"></i>
      <h3 class="text-lg font-semibold">Performances QMS</h3>
    </div>
    <div class="p-5 text-gray-700 text-sm leading-relaxed">
      Vue d’ensemble des indicateurs de performance qualité.
    </div>
  </div>

  <!-- Carte 2 -->
  <div class="bg-white border border-gray-200 rounded-xl shadow-md hover:shadow-xl transition duration-300">
    <div class="flex items-center gap-3 px-5 py-4 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-t-xl">
      <i class="bi bi-gear text-xl"></i>
      <h3 class="text-lg font-semibold">Équipements</h3>
    </div>
    <div class="p-5 text-gray-700 text-sm leading-relaxed">
      Suivi des maintenances, calibrations et historiques.
    </div>
  </div>

  <!-- Carte 3 -->
  <div class="bg-white border border-gray-200 rounded-xl shadow-md hover:shadow-xl transition duration-300">
    <div class="flex items-center gap-3 px-5 py-4 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-t-xl">
      <i class="bi bi-shield-check text-xl"></i>
      <h3 class="text-lg font-semibold">Audits internes</h3>
    </div>
    <div class="p-5 text-gray-700 text-sm leading-relaxed">
      Préparez et suivez vos audits qualité de manière optimale.
    </div>
  </div>
</div>
@endsection
