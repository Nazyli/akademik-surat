<?php

namespace Database\Seeders;

use App\Models\DashboardNews;
use App\Models\Department;
use App\Models\FormTemplates;
use App\Models\FormType;
use App\Models\RoleMembership;
use App\Models\StudyProgram;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // php artisan db:wipe -> menghapus semua database
        // php artisan migrate -> buat database
        // php artisan migrate:refresh -> update refresh
        // php artisan db:seed --class=CreateUsersSeeder


        // php artisan make:model Todo -mcr
        // -m, --migration Create a new migration file for the model.
        // -c, --controller Create a new controller for the model.
        // -r, --resource Indicates if the generated controller should be a resource controller
        // php artisan make:model Todo -a (--all Generate a migration, factory, and resource controller for the model)
        DB::transaction(function () {

            DB::table('role_memberships')->insert([
                [
                    'id' => 1,
                    'name' => 'Admin',

                ],
                [
                    'id' => 2,
                    'name' => 'User',
                ]

            ]);

            /* Form Type */

            $formType = [
                [
                    'id' => "FT01",
                    'name' => 'Akademik',
                    'status' => 'Active',
                ],
                [
                    'id' => "FT02",
                    'name' => 'Skripsi, Tesis, Promosi',
                    'status' => 'Active',
                ],
            ];

            foreach ($formType as $key => $value) {
                DB::table('form_types')->insert($value);
            }

            $formTemplates = [
                [
                    "id" => "0cedfff2-9449-47b2-ab56-266bf108e4eb",
                    "template_name" => "Form Keterangan Mahasiswa Aktif",
                    "size_file" => "178688",
                    "url_file" => "file/template-surat/Formulir-Permohonan-Surat-Keterangan-Mahasiswa-Aktif-BR-(Statement-Letter-as-Registered-Student-Request-Form).doc",
                    "type_id" => "FT01",
                    "status" => "Active",
                    "sort_order" => 1,
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "35605b7d-b7b5-4315-b83e-2d779522cded",
                    "template_name" => "Form Permohonan Transkrip Nilai",
                    "size_file" => "149504",
                    "url_file" => "file/template-surat/Formulir-Permohonan-Transkrip-Nilai-(Faculty-Transcripts-Request-Form).doc",
                    "type_id" => "FT01",
                    "status" => "Active",
                    "sort_order" => 2,
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "dd4f7204-3495-442c-a182-624d904da2b4",
                    "template_name" => "Form Syarat Pembuatan SKL",
                    "size_file" => "139911",
                    "url_file" => "file/template-surat/Borang_Syarat_Pembuatan_SKL-(Statement-Form-of-Diploma-and-Transcripts)-.docx",
                    "type_id" => "FT01",
                    "status" => "Active",
                    "sort_order" => 3,
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "fce6e39f-e2f4-4ccb-8fc4-b60491a3405f",
                    "template_name" => "Form Pernyataan Kehilangan Ijazah",
                    "size_file" => "145920",
                    "url_file" => "file/template-surat/Formulir-Pernyataan-Kehilangan-Ijazah-(Statement-Letter-for-the-Lost-Diploma).doc",
                    "type_id" => "FT01",
                    "status" => "Active",
                    "sort_order" => 4,
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "4c0954a2-5d51-43d6-b2d8-d8f5e6d6f396",
                    "template_name" => "Form Pernyataan Kehilangan Transkrip",
                    "size_file" => "145408",
                    "url_file" => "file/template-surat/Formulir-Pernyataan-Kehilangan-Transkrip-(Statement-Letter-for-the-Lost-Transcript).doc",
                    "type_id" => "FT01",
                    "status" => "Active",
                    "sort_order" => 5,
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "bc0351c6-7f37-43fc-b785-1d36229c34b9",
                    "template_name" => "Form Tunda Registrasi S2 dan S3(Diterima Gasal Gel.1 Registrasi ke Gel.2)",
                    "size_file" => "126113",
                    "url_file" => "file/template-surat/Formulir-Permohonan-Tunda-Registrasi-S2-dan-S3-(Recommendation-Letter-Request-Form-for-Master-and-Doctorate-Registration-Postponement).docx",
                    "type_id" => "FT01",
                    "status" => "Active",
                    "sort_order" => 6,
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "34f67c55-c133-40ae-a3ee-967ddc617b1c",
                    "template_name" => "Form Permohonan Tunda Kuliah S2 dan S3",
                    "size_file" => "125807",
                    "url_file" => "file/template-surat/Formulir-Permohonan-Tunda-Kuliah-S2-dan-S3-(Recommendation-Letter-Request-Form-for-Master-and-Doctorate-Study-Postponement).docx",
                    "type_id" => "FT01",
                    "status" => "Active",
                    "sort_order" => 7,
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "a571deef-b990-4a46-a856-fc4cadaf873a",
                    "template_name" => "Form Permohonan Aktif Kuliah S2 dan S3",
                    "size_file" => "127566",
                    "url_file" => "file/template-surat/Formulir-Permohonan-Aktif-Kuliah-S2-dan-S3-(Recommendation-Letter-Request-Form-for-Registered-Post-graduate-Student).docx",
                    "type_id" => "FT01",
                    "status" => "Active",
                    "sort_order" => 8,
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "6fd114f0-82de-4d4c-8175-b3a6b867c35d",
                    "template_name" => "Form Pengantar Kerja Praktik",
                    "size_file" => "127772",
                    "url_file" => "file/template-surat/Formulir-permohonan-Pengantar-kerja-Praktek-(Recommendation-Letter-Request-Form-for-Professional-Placement).docx",
                    "type_id" => "FT01",
                    "status" => "Active",
                    "sort_order" => 9,
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "072a3911-8778-44b9-a122-f6af3249bef3",
                    "template_name" => "Form Pengantar Magang",
                    "size_file" => "127309",
                    "url_file" => "file/template-surat/Formulir-Permohonan-Pengantar-Magang-(Recommendation-Letter-Request-Form-for-Internship).docx",
                    "type_id" => "FT01",
                    "status" => "Active",
                    "sort_order" => 10,
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "ff274dd1-5697-4aaa-90bf-e0e693973c1e",
                    "template_name" => "Form Permohonan Kuliah Lintas Fakultas",
                    "size_file" => "127029",
                    "url_file" => "file/template-surat/Formulir-Permohonan-Kuliah-Lintas-Fakultas-2-(Recommendation-Letter-Request-Form-for-Cross-Faculty-Study).docx",
                    "type_id" => "FT01",
                    "status" => "Active",
                    "sort_order" => 11,
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "0bae17a6-cd0c-48f1-9339-7f32a18fa4fa",
                    "template_name" => "Form Penyerahan Berkas Kelengkapan Penerbitan Ijazah dan Transkrip",
                    "size_file" => "130065",
                    "url_file" => "file/template-surat/Borang-Berkas-kelengkapan-Penerbitan-Ijasah-dan-Transkrip.docx",
                    "type_id" => "FT01",
                    "status" => "Active",
                    "sort_order" => 12,
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "74ae7f89-28d4-46cd-a349-dcbe6a611fb0",
                    "template_name" => "Form Keterangan Pengambilan Ijazah, Transkrip Nilai, dan SKPI",
                    "size_file" => "191488",
                    "url_file" => "file/template-surat/Formulir-Persyaratan-Pengambilan-Ijazah,-Transkrip-Nilai,-dan-SKPI-(Statement-Form-of-Diploma,-Transcript,-and-DS).doc",
                    "type_id" => "FT01",
                    "status" => "Active",
                    "sort_order" => 13,
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "208fc9cf-30d7-41bd-9e6f-521deb8a5bd8",
                    "template_name" => "Form Pengunduran Diri",
                    "size_file" => "128999",
                    "url_file" => "file/template-surat/Formulir-Permohonan-pengunduran-diri-(Resignation-Form).docx",
                    "type_id" => "FT01",
                    "status" => "Active",
                    "sort_order" => 14,
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "0e97a01b-6a96-4fdb-8ed4-cfb22a2e93bf",
                    "template_name" => "Form Cuti Akademik",
                    "size_file" => "125815",
                    "url_file" => "file/template-surat/Formulir-Permohonan-Cuti-Akademik-(Academic-Leave-Form).docx",
                    "type_id" => "FT01",
                    "status" => "Active",
                    "sort_order" => 15,
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "6da46423-ef13-4feb-888e-8017831cc664",
                    "template_name" => "Form Permohonan Perbaikan Nilai",
                    "size_file" => "126989",
                    "url_file" => "file/template-surat/Formulir-Permohonan-Perbaikan-Nilai-(Grade-Improvement-Request-Form).docx",
                    "type_id" => "FT01",
                    "status" => "Active",
                    "sort_order" => 16,
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "34b7542d-e185-43d2-844a-950e0f5bff58",
                    "template_name" => "Form Permohonan Pengantar Data",
                    "size_file" => "127552",
                    "url_file" => "file/template-surat/Formulir-Permohonan-Pengantar-Data-(Recommendation-Letter-Request-Form-for-Institution-or-Company).docx",
                    "type_id" => "FT01",
                    "status" => "Active",
                    "sort_order" => 17,
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "bde14d78-40f0-41da-91ec-e45dbd7f2b0c",
                    "template_name" => "Form Add u0026 Drop MK",
                    "size_file" => "126650",
                    "url_file" => "file/template-surat/Formulir-Permohonan-Add-dan-Drop-Mata-Kuliah-(Adding-and-Dropping-Course-Request-Form).docx",
                    "type_id" => "FT01",
                    "status" => "Active",
                    "sort_order" => 18,
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "bae4f1da-fb10-4920-8ee8-f87ce434268f",
                    "template_name" => "Form Permohonan Pengantar Rekomendasi",
                    "size_file" => "126024",
                    "url_file" => "file/template-surat/Formulir-Permohonan-Pengantar-Rekomendasi-(Recommendation-Letter-Request-Form-for-General-Purposes).docx",
                    "type_id" => "FT01",
                    "status" => "Active",
                    "sort_order" => 19,
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "969b160f-c36e-4149-bb7c-dea2642b5489",
                    "template_name" => "Form Permohonan Transfer Kredit Fakultas",
                    "size_file" => "126695",
                    "url_file" => "file/template-surat/Borang-Transfer-Kredit_Credit-Earning-untuk-Fakultas-(Academic-Credit-Earning-Transfer-Form).docx",
                    "type_id" => "FT01",
                    "status" => "Active",
                    "sort_order" => 20,
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "bd91d876-607d-40e1-a05c-d58877fa9bef",
                    "template_name" => "Form Permohonan Transfer Kredit Departemen",
                    "size_file" => "124624",
                    "url_file" => "file/template-surat/Borang-Transfer-Kredit_Credit-Earning-untuk-Departemen-(Academic-Credit-Earning-Transfer-Form).docx.docx",
                    "type_id" => "FT01",
                    "status" => "Active",
                    "sort_order" => 21,
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "bf2ea00f-34e5-4ce1-b5d9-7a03377d69fa",
                    "template_name" => "Form Pendaftaran Skripsi",
                    "size_file" => "240305",
                    "url_file" => "file/template-surat/Borang-Pendaftaran-Skripsi-(Undergraduate-Thesis-Application-Form).docx",
                    "type_id" => "FT02",
                    "status" => "Active",
                    "sort_order" => 1,
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "febb6cd1-b119-4d18-85ee-1ffb2787d475",
                    "template_name" => "Form Pendaftaran Tesis",
                    "size_file" => "348513",
                    "url_file" => "file/template-surat/Borang-Pendaftaran-Tesis-(Thesis-Application-Form).docx",
                    "type_id" => "FT02",
                    "status" => "Active",
                    "sort_order" => 2,
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "efd6c9f3-6a5a-4dad-a5fe-bda506cb6fab",
                    "template_name" => "Form Pendaftaran Promosi Doktor",
                    "size_file" => "348277",
                    "url_file" => "file/template-surat/Borang-Pendaftaran-Promosi-(Doctoral-Promotion-Application-Form).docx",
                    "type_id" => "FT02",
                    "status" => "Active",
                    "sort_order" => 3,
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
            ];
            foreach ($formTemplates as $key => $value) {
                DB::table('form_templates')->insert($value);
            }

            $departments = [
                [
                    "id" => "5831b2c9-511c-4e1c-b36e-97dad5f33df4",
                    "department_code" => "B01",
                    "department_name" => "Biologi",
                    "status" => "Active",
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "ffa0c5a1-71be-4d00-af42-363cfc35097f",
                    "department_code" => "F01",
                    "department_name" => "Fisika",
                    "status" => "Active",
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "cd19c0e4-c4ad-48ab-8087-9da76c4912de",
                    "department_code" => "G01",
                    "department_name" => "Geografi",
                    "status" => "Active",
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "7f613eaf-1d94-46af-b5ee-cc2f1bd6646e",
                    "department_code" => "G02",
                    "department_name" => "Geosains",
                    "status" => "Active",
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "cecb90ac-de5a-4a49-8cd1-fa882588d999",
                    "department_code" => "K01",
                    "department_name" => "Kimia",
                    "status" => "Active",
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "49b2a4b3-c60c-4e21-a9cb-a260c277cc47",
                    "department_code" => "M01",
                    "department_name" => "Matematika",
                    "status" => "Active",
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
            ];
            foreach ($departments as $key => $value) {
                DB::table('departments')->insert($value);
            }

            $studyPrograms = [
                [
                    "id" => "dcb1ec1f-595a-448a-821f-7ff3f2e05680",
                    "study_program_code" => "BL01",
                    "study_program_name" => "S1 Biologi",
                    "department_id" => "5831b2c9-511c-4e1c-b36e-97dad5f33df4",
                    "status" => "Active",
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "e3985b94-4b63-4048-bec0-f38c0fdd55d1",
                    "study_program_code" => "F01",
                    "study_program_name" => "S1 Fisika",
                    "department_id" => "ffa0c5a1-71be-4d00-af42-363cfc35097f",
                    "status" => "Active",
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "90aaf562-7994-4644-9ac7-20337a4611bf",
                    "study_program_code" => "FI01",
                    "study_program_name" => "S1 Fisika Instrumen",
                    "department_id" => "ffa0c5a1-71be-4d00-af42-363cfc35097f",
                    "status" => "Active",
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "f8260697-cc41-4bd4-ad02-8aa482b470e2",
                    "study_program_code" => "GF01",
                    "study_program_name" => "S1 Geofisika",
                    "department_id" => "7f613eaf-1d94-46af-b5ee-cc2f1bd6646e",
                    "status" => "Active",
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "1668158f-02f7-46fe-aeda-3d7cea16eafd",
                    "study_program_code" => "GG01",
                    "study_program_name" => "S1 Geografi",
                    "department_id" => "cd19c0e4-c4ad-48ab-8087-9da76c4912de",
                    "status" => "Active",
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "90d5833b-4141-4db6-b152-bff34d4429ef",
                    "study_program_code" => "GL01",
                    "study_program_name" => "S1 Geologi",
                    "department_id" => "7f613eaf-1d94-46af-b5ee-cc2f1bd6646e",
                    "status" => "Active",
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "f9453762-88b3-4cd8-8de6-468d5c548b69",
                    "study_program_code" => "IA01",
                    "study_program_name" => "S1 Ilmu Aktuaria",
                    "department_id" => "49b2a4b3-c60c-4e21-a9cb-a260c277cc47",
                    "status" => "Active",
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "b6283e42-e385-4da4-94fc-d43b42345007",
                    "study_program_code" => "KM01",
                    "study_program_name" => "S1 Kimia",
                    "department_id" => "cecb90ac-de5a-4a49-8cd1-fa882588d999",
                    "status" => "Active",
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "c4de6a3b-6b47-4ece-9cf6-8e0dcf20cc6d",
                    "study_program_code" => "MM01",
                    "study_program_name" => "S1 Matematika",
                    "department_id" => "49b2a4b3-c60c-4e21-a9cb-a260c277cc47",
                    "status" => "Active",
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "2a7e4cb8-590a-44b7-a6ef-e4208bd319e0",
                    "study_program_code" => "ST01",
                    "study_program_name" => "S1 Statistika",
                    "department_id" => "49b2a4b3-c60c-4e21-a9cb-a260c277cc47",
                    "status" => "Active",
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "0e329a98-ac38-4235-a5fb-19112d5a73f8",
                    "study_program_code" => "BL02",
                    "study_program_name" => "S2 Biologi",
                    "department_id" => "5831b2c9-511c-4e1c-b36e-97dad5f33df4",
                    "status" => "Active",
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "842a94c2-0aec-437a-bd78-57e6c09d4bb5",
                    "study_program_code" => "FM01",
                    "study_program_name" => "S2 Fisika Medis",
                    "department_id" => "ffa0c5a1-71be-4d00-af42-363cfc35097f",
                    "status" => "Active",
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "c97b8afa-b270-45e2-bb9e-68b39531f2a1",
                    "study_program_code" => "IB01",
                    "study_program_name" => "S2 Ilmu Bahan\/Material",
                    "department_id" => "ffa0c5a1-71be-4d00-af42-363cfc35097f",
                    "status" => "Active",
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "0d4faa03-ef10-4bc3-9ae9-dcf8a2cbe045",
                    "study_program_code" => "FS02",
                    "study_program_name" => "S2 Ilmu Fisika",
                    "department_id" => "ffa0c5a1-71be-4d00-af42-363cfc35097f",
                    "status" => "Active",
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "5afd20b4-f96c-4b70-aab4-0014bf3ff8aa",
                    "study_program_code" => "GG02",
                    "study_program_name" => "S2 Ilmu Geografi",
                    "department_id" => "cd19c0e4-c4ad-48ab-8087-9da76c4912de",
                    "status" => "Active",
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "93cb7b3d-01d4-4502-a13b-ddcedb8ad06e",
                    "study_program_code" => "IK01",
                    "study_program_name" => "S2 Ilmu Kelautan",
                    "department_id" => "5831b2c9-511c-4e1c-b36e-97dad5f33df4",
                    "status" => "Active",
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "05830b5c-9c96-4789-b826-ca20b37374c3",
                    "study_program_code" => "KM02",
                    "study_program_name" => "S2 Ilmu Kimia",
                    "department_id" => "cecb90ac-de5a-4a49-8cd1-fa882588d999",
                    "status" => "Active",
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "ff928a29-2e01-4a92-a602-b500958d4864",
                    "study_program_code" => "MM02",
                    "study_program_name" => "S2 Matematika",
                    "department_id" => "49b2a4b3-c60c-4e21-a9cb-a260c277cc47",
                    "status" => "Active",
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "abff7b74-8239-4228-97ff-6dcbd405026f",
                    "study_program_code" => "IB02",
                    "study_program_name" => "S3 Ilmu Bahan\/Material",
                    "department_id" => "ffa0c5a1-71be-4d00-af42-363cfc35097f",
                    "status" => "Active",
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "f87d592b-144e-48ef-af4b-b931d601f3a4",
                    "study_program_code" => "FS03",
                    "study_program_name" => "S3 Ilmu Fisika",
                    "department_id" => "ffa0c5a1-71be-4d00-af42-363cfc35097f",
                    "status" => "Active",
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "dcdc8430-4ef5-4178-90c3-2d36fdaefed8",
                    "study_program_code" => "KM03",
                    "study_program_name" => "S3 Ilmu Kimia",
                    "department_id" => "cecb90ac-de5a-4a49-8cd1-fa882588d999",
                    "status" => "Active",
                    "created_by" => "System",
                    "updated_by" => "System",
                ]
            ];
            foreach ($studyPrograms as $key => $value) {
                DB::table('study_programs')->insert($value);
            }

            $dashboardNews = [
                [
                    "id" => "00d77181-1a8c-4981-ac13-d1c7ce83d73d",
                    "title" => "https://s.id/Persyaratan_Pengambilan_Ijazah_Transkrip_SKPI",
                    "body" => "Persyaratan Pengambilan Ijazah dan Transkip",
                    "img_url" => "file/berita-dashboard/banner.jpg",
                    "status" => "Active",
                    "sort_order" => 1,
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "61c6fe14-66e8-49f2-8673-cfbb6a159ba4",
                    "title" => "https://www.sci.ui.ac.id/it-support/",
                    "body" => "https://www.sci.ui.ac.id/it-support/",
                    "img_url" => "file/berita-dashboard/banner2.png",
                    "status" => "Active",
                    "sort_order" => 2,
                    "created_by" => "System",
                    "updated_by" => "System",
                ],
                [
                    "id" => "27656303-7171-4bad-ba60-f554a415ca2b",
                    "title" => "https://www.sci.ui.ac.id/aturan-dan-pedoman/",
                    "body" => null,
                    "img_url" => "file/berita-dashboard/banner3.jpg",
                    "status" => "Active",
                    "sort_order" => 3,
                    "created_by" => "System",
                    "updated_by" => "System",
                ]
            ];
            foreach ($dashboardNews as $key => $value) {
                DB::table('dashboard_news')->insert($value);
            }

            $otherMenus = [
                [
                    "id" => "MENU1",
                    "menu_name" => "Pengambilan Ijazah",
                    "url" => "https://s.id/Persyaratan_Pengambilan_Ijazah_Transkrip_SKPI",
                    "status" => "Active",
                    "sort_order" => 1,
                    "created_by" => "System",
                    "updated_by" => "System",
                ]
            ];
            foreach ($otherMenus as $key => $value) {
                DB::table('other_menus')->insert($value);
            }


            $user = [
                [
                    'id' => "administrator",
                    'first_name' => 'Administrator',
                    'last_name' => 'SIPA',
                    'phone' => '087657890377',
                    'email' => 'sipa@sci.ui.ac.id',
                    'role_id' => '1',
                    'img_url' => 'file/avatars/administrator.png',
                    'status' => 'Active',
                    'password' => bcrypt('F4kult4$'),
                ],
                [
                    'id' => Str::uuid(),
                    'first_name' => 'Admin',
                    'last_name' => 'Dummy',
                    'phone' => '087657890377',
                    'email' => 'admin@gmail.com',
                    'role_id' => '1',
                    'img_url' => 'file/avatars/admin.png',
                    'status' => 'Active',
                    'password' => bcrypt('123456'),
                ],
                [
                    'id' => Str::uuid(),
                    'first_name' => 'User',
                    'last_name' => 'Dummy',
                    'phone' => '087657890377',
                    'email' => 'user@gmail.com',
                    'role_id' => '2',
                    'img_url' => 'file/avatars/user.jpg',
                    'npm' => '2306000000',
                    "study_program_id" => "dcb1ec1f-595a-448a-821f-7ff3f2e05680",
                    "department_id" => "5831b2c9-511c-4e1c-b36e-97dad5f33df4",
                    'status' => 'Active',
                    'password' => bcrypt('123456'),
                ],
            ];

            foreach ($user as $key => $value) {
                DB::table('users')->insert($value);
            }
        });
    }
}
