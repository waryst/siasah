<?php

namespace App\View\Components;

use App\Models\Laporan;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DataLaporan extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $sekolah_id = auth()->user()->datasekolah_id;
        if(request()->path()=="cetaklaporan")
        {
            $kirim['data_laporan'] = Laporan::where([['datasekolah_id', $sekolah_id],['status', 1]])->orderBy('id', 'DESC')->get();
        }
        else{
            $kirim['data_laporan'] = Laporan::where([['datasekolah_id', $sekolah_id]])->orderBy('id', 'DESC')->get();
        }
        return view('components.data-laporan',$kirim);
    }
}
