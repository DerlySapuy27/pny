<?php

namespace App\Http\Controllers;

use App\Models\Employee;

use Illuminate\Http\Request;

class LicenseController extends Controller
{
    public function index()
    {
        // Filtra empleados cuyo estado de entrega sea "NO"
        $employees = Employee::where('delivered', false)->get();
        return view('carnet.index', compact('employees'));
    }

    public function empleadolist()
    {
        $employees = Employee::where('delivered', false)->get();
        return response()->json(['employees' => $employees]);
    }


    public function preview(Request $request)
    {
        // Lógica para procesar los empleados seleccionados y redirigir a la vista previa
        $encodedDetails = $request->input('details', '[]');
        $decodedDetails = json_decode(urldecode($encodedDetails), true);
        // Puedes validar si $decodedDetails es un array antes de pasar a la vista
        $selectedEmployeeDetails = is_array($decodedDetails) ? $decodedDetails : [];
        // Pasar los datos a la vista de vista previa
        return view('carnet.preview', compact('selectedEmployeeDetails'));
    }


    public function getEmployeeDetails(Request $request)
    {
        $selectedEmployeeIds = $request->input('selectedEmployees', []);
        // Verificar si $selectedEmployeeIds es un array antes de realizar la consulta
        if (is_array($selectedEmployeeIds) && count($selectedEmployeeIds) > 0) {
            $selectedEmployees = Employee::whereIn('id', $selectedEmployeeIds)->get();
        } else {
            // Si $selectedEmployeeIds no es un array válido, establecer $selectedEmployees como un array vacío
            $selectedEmployees = [];
        }
        // Devolver la vista preview con los detalles de los empleados
        return view('carnet.preview', ['selectedEmployees' => $selectedEmployees]);
    }



    public function generateCarnet(Request $request)
    {
        // Lógica para procesar los empleados seleccionados y redirigir a la vista previa
        $selectedEmployeeIds = $request->input('selectedEmployees', []);
        // Puedes obtener los detalles de los empleados seleccionados desde la base de datos
        $selectedEmployees = Employee::whereIn('id', $selectedEmployeeIds)->get();
        // Pasar los datos a la vista de vista previa
        return view('carnet.preview', ['selectedEmployees' => $selectedEmployees]);
    }



    public function acta(){
        $employees = Employee::all(); // Suponiendo que estás recuperando todos los empleados de tu base de datos
        return view('carnet.acta', ['employees' => $employees]);}

        public function generateActas($employeeIds){
            // Convertir la cadena de IDs de empleados en un array
            $employeeIdsArray = explode(',', $employeeIds);

            // Recuperar los detalles de todos los empleados seleccionados utilizando los IDs recibidos
            $employees = Employee::whereIn('id', $employeeIdsArray)->get();

            // Pasar los detalles de los empleados a la vista de acta de entrega
            return view('carnet.actapreview', compact('employees'));
        }







}
