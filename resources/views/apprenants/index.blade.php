@extends('layouts.app-sidebar')

@section('title', 'Apprenants - Gestion Bulletin CPET')

@section('content')
<div style="max-width: 1200px; margin: 0 auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;">
        <h1 style="font-size: 28px; font-weight: 600; color: #111827;">Apprenants</h1>
        <a href="{{ route('apprenants.create') }}" style="display: inline-flex; align-items: center; padding: 10px 20px; background: linear-gradient(135deg, #0052CC 0%, #003D99 100%); color: white; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0 8px 20px rgba(0, 82, 204, 0.3)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow=''; this.style.transform=''">➕ Ajouter un apprenant</a>
    </div>

    @if($apprenants->count())
        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                <thead style="background-color: #F3F4F6; border-bottom: 1px solid #E5E7EB;">
                    <tr>
                        <th style="padding: 16px; text-align: left; font-weight: 600; color: #111827;">Nom</th>
                        <th style="padding: 16px; text-align: left; font-weight: 600; color: #111827;">Prénom</th>
                        <th style="padding: 16px; text-align: left; font-weight: 600; color: #111827;">Matricule</th>
                        <th style="padding: 16px; text-align: left; font-weight: 600; color: #111827;">Sexe</th>
                        <th style="padding: 16px; text-align: left; font-weight: 600; color: #111827;">Filière</th>
                        <th style="padding: 16px; text-align: left; font-weight: 600; color: #111827;">Classe</th>
                        <th style="padding: 16px; text-align: left; font-weight: 600; color: #111827;">Reboublant</th>
                        <th style="padding: 16px; text-align: left; font-weight: 600; color: #111827;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($apprenants as $apprenant)
                        <tr style="border-bottom: 1px solid #E5E7EB;">
                            <td style="padding: 16px; color: #111827;">{{ $apprenant->nom }}</td>
                            <td style="padding: 16px; color: #111827;">{{ $apprenant->prenom }}</td>
                            <td style="padding: 16px; color: #111827;">{{ $apprenant->matricule }}</td>
                            <td style="padding: 16px; color: #111827;">{{ $apprenant->sexe }}</td>
                            <td style="padding: 16px; color: #111827;">{{ $apprenant->filiere?->nom_filiere ?? 'N/A' }}</td>
                            <td style="padding: 16px; color: #111827;">{{ $apprenant->classe?->nom_classe ?? 'N/A' }}</td>
                            <td style="padding: 16px;">
                                @if($apprenant->reboublant)
                                    <span style="display: inline-block; padding: 4px 12px; background-color: #FEF3C7; color: #78350F; border-radius: 20px; font-size: 12px; font-weight: 600;">Oui</span>
                                @else
                                    <span style="display: inline-block; padding: 4px 12px; background-color: #ECFDF5; color: #065F46; border-radius: 20px; font-size: 12px; font-weight: 600;">Non</span>
                                @endif
                            </td>
                            <td style="padding: 16px;">
                                <a href="{{ route('apprenants.edit', $apprenant) }}" style="color: #0052CC; text-decoration: none; margin-right: 16px; font-weight: 600;">Modifier</a>
                                <form action="{{ route('apprenants.destroy', $apprenant) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: none; border: none; color: #DC2626; cursor: pointer; text-decoration: none; font-weight: 600;">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px;">
            {{ $apprenants->links() }}
        </div>
    @else
        <div style="background: white; border-radius: 12px; padding: 40px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
            <p style="color: #4B5563; font-size: 16px;">Aucun apprenant trouvé.</p>
        </div>
    @endif
</div>
@endsection
