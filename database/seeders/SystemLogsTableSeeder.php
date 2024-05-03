<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SystemLogsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('system_logs')->delete();
        
        \DB::table('system_logs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-06-25 14:05:56',
                'action' => 'login',
                'type' => NULL,
                'type_id' => 0,
                'detail' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-06-25 14:09:34',
                'action' => 'login',
                'type' => NULL,
                'type_id' => 0,
                'detail' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-06-25 14:12:00',
                'action' => 'login',
                'type' => NULL,
                'type_id' => 0,
                'detail' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-06-25 14:20:10',
                'action' => 'login',
                'type' => NULL,
                'type_id' => 0,
                'detail' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-06-25 14:21:51',
                'action' => 'login',
                'type' => NULL,
                'type_id' => 0,
                'detail' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-06-25 14:23:04',
                'action' => 'login',
                'type' => NULL,
                'type_id' => 0,
                'detail' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-06-25 14:26:36',
                'action' => 'login',
                'type' => NULL,
                'type_id' => 0,
                'detail' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-06-25 14:27:02',
                'action' => 'login',
                'type' => NULL,
                'type_id' => 0,
                'detail' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-06-25 15:40:31',
                'action' => 'login',
                'type' => NULL,
                'type_id' => 0,
                'detail' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-06-25 16:26:46',
                'action' => 'login',
                'type' => NULL,
                'type_id' => 0,
                'detail' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-06-27 14:53:19',
                'action' => 'login',
                'type' => NULL,
                'type_id' => 0,
                'detail' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 14:13:52',
                'action' => 'login',
                'type' => NULL,
                'type_id' => 0,
                'detail' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 14:24:14',
                'action' => 'create',
                'type' => 'attributes',
                'type_id' => 1,
                'detail' => 'eyJmaWVsZHMiOlsibmFtZSIsInNsdWciLCJkaXNwbGF5X2xheW91dCIsImlzX3NlYXJjaGFibGUiLCJzdGF0dXMiLCJjcmVhdGVkX2F0IiwidXBkYXRlZF9hdCJdLCJkYXRhIjp7Im5hbWUiOiJNXHUwMGUwdSIsInNsdWciOiJtYXUiLCJkaXNwbGF5X2xheW91dCI6InRleHQiLCJpc19zZWFyY2hhYmxlIjoiMSIsInN0YXR1cyI6IjEiLCJjcmVhdGVkX2F0IjoiMjAyMS0wNy0wNSAxNDoyNDoxNCIsInVwZGF0ZWRfYXQiOiIyMDIxLTA3LTA1IDE0OjI0OjE0In19',
            ),
            13 => 
            array (
                'id' => 14,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 14:24:42',
                'action' => 'create',
                'type' => 'attributes',
                'type_id' => 2,
                'detail' => 'eyJmaWVsZHMiOlsibmFtZSIsInNsdWciLCJkaXNwbGF5X2xheW91dCIsImlzX3NlYXJjaGFibGUiLCJzdGF0dXMiLCJjcmVhdGVkX2F0IiwidXBkYXRlZF9hdCJdLCJkYXRhIjp7Im5hbWUiOiJTaXplIiwic2x1ZyI6InNpemUiLCJkaXNwbGF5X2xheW91dCI6InRleHQiLCJpc19zZWFyY2hhYmxlIjoiMSIsInN0YXR1cyI6IjEiLCJjcmVhdGVkX2F0IjoiMjAyMS0wNy0wNSAxNDoyNDo0MiIsInVwZGF0ZWRfYXQiOiIyMDIxLTA3LTA1IDE0OjI0OjQyIn19',
            ),
            14 => 
            array (
                'id' => 15,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 14:25:09',
                'action' => 'create',
                'type' => 'attributes',
                'type_id' => 3,
                'detail' => 'eyJmaWVsZHMiOlsibmFtZSIsInNsdWciLCJkaXNwbGF5X2xheW91dCIsImlzX3NlYXJjaGFibGUiLCJzdGF0dXMiLCJjcmVhdGVkX2F0IiwidXBkYXRlZF9hdCJdLCJkYXRhIjp7Im5hbWUiOiJSYW0iLCJzbHVnIjoicmFtIiwiZGlzcGxheV9sYXlvdXQiOiJ0ZXh0IiwiaXNfc2VhcmNoYWJsZSI6IjEiLCJzdGF0dXMiOiIxIiwiY3JlYXRlZF9hdCI6IjIwMjEtMDctMDUgMTQ6MjU6MDkiLCJ1cGRhdGVkX2F0IjoiMjAyMS0wNy0wNSAxNDoyNTowOSJ9fQ==',
            ),
            15 => 
            array (
                'id' => 16,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 14:25:39',
                'action' => 'create',
                'type' => 'brands',
                'type_id' => 1,
                'detail' => 'eyJmaWVsZHMiOlsibmFtZSIsInNsdWciLCJpbWFnZSIsImRldGFpbCIsInN0YXR1cyIsImNyZWF0ZWRfYXQiLCJ1cGRhdGVkX2F0Il0sImRhdGEiOnsibmFtZSI6IkFwcGxlIiwic2x1ZyI6ImFwcGxlIiwiaW1hZ2UiOiIiLCJkZXRhaWwiOiIiLCJzdGF0dXMiOiIxIiwiY3JlYXRlZF9hdCI6IjIwMjEtMDctMDUgMTQ6MjU6MzkiLCJ1cGRhdGVkX2F0IjoiMjAyMS0wNy0wNSAxNDoyNTozOSJ9fQ==',
            ),
            16 => 
            array (
                'id' => 17,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 14:25:51',
                'action' => 'create',
                'type' => 'brands',
                'type_id' => 2,
                'detail' => 'eyJmaWVsZHMiOlsibmFtZSIsInNsdWciLCJpbWFnZSIsImRldGFpbCIsInN0YXR1cyIsImNyZWF0ZWRfYXQiLCJ1cGRhdGVkX2F0Il0sImRhdGEiOnsibmFtZSI6IlNhbXN1bmciLCJzbHVnIjoic2Ftc3VuZyIsImltYWdlIjoiIiwiZGV0YWlsIjoiIiwic3RhdHVzIjoiMSIsImNyZWF0ZWRfYXQiOiIyMDIxLTA3LTA1IDE0OjI1OjUxIiwidXBkYXRlZF9hdCI6IjIwMjEtMDctMDUgMTQ6MjU6NTEifX0=',
            ),
            17 => 
            array (
                'id' => 18,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 14:26:16',
                'action' => 'create',
                'type' => 'taxes',
                'type_id' => 1,
                'detail' => 'eyJmaWVsZHMiOlsidGl0bGUiLCJwZXJjZW50YWdlIiwicHJpb3JpdHkiLCJzdGF0dXMiLCJjcmVhdGVkX2F0IiwidXBkYXRlZF9hdCJdLCJkYXRhIjp7InRpdGxlIjoiVkFUIiwicGVyY2VudGFnZSI6IjEwIiwicHJpb3JpdHkiOiIxIiwic3RhdHVzIjoiMSIsImNyZWF0ZWRfYXQiOiIyMDIxLTA3LTA1IDE0OjI2OjE2IiwidXBkYXRlZF9hdCI6IjIwMjEtMDctMDUgMTQ6MjY6MTYifX0=',
            ),
            18 => 
            array (
                'id' => 19,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 14:26:42',
                'action' => 'create',
                'type' => 'product_categories',
                'type_id' => 1,
                'detail' => 'eyJmaWVsZHMiOlsicGFyZW50X2lkIiwibmFtZSIsInNsdWciLCJpbWFnZSIsImRldGFpbCIsInN0YXR1cyIsImNyZWF0ZWRfYXQiLCJ1cGRhdGVkX2F0Il0sImRhdGEiOnsicGFyZW50X2lkIjoiMCIsIm5hbWUiOiJcdTAxMTBpXHUxZWM3biB0aG9cdTFlYTFpIiwic2x1ZyI6ImRpZW4tdGhvYWkiLCJpbWFnZSI6IiIsImRldGFpbCI6IiIsInN0YXR1cyI6IjEiLCJjcmVhdGVkX2F0IjoiMjAyMS0wNy0wNSAxNDoyNjo0MiIsInVwZGF0ZWRfYXQiOiIyMDIxLTA3LTA1IDE0OjI2OjQyIn19',
            ),
            19 => 
            array (
                'id' => 20,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 14:26:59',
                'action' => 'create',
                'type' => 'product_categories',
                'type_id' => 2,
                'detail' => 'eyJmaWVsZHMiOlsicGFyZW50X2lkIiwibmFtZSIsInNsdWciLCJpbWFnZSIsImRldGFpbCIsInN0YXR1cyIsImNyZWF0ZWRfYXQiLCJ1cGRhdGVkX2F0Il0sImRhdGEiOnsicGFyZW50X2lkIjoiMCIsIm5hbWUiOiJUaFx1MWVkZGkgdHJhbmciLCJzbHVnIjoidGhvaS10cmFuZyIsImltYWdlIjoiIiwiZGV0YWlsIjoiIiwic3RhdHVzIjoiMSIsImNyZWF0ZWRfYXQiOiIyMDIxLTA3LTA1IDE0OjI2OjU5IiwidXBkYXRlZF9hdCI6IjIwMjEtMDctMDUgMTQ6MjY6NTkifX0=',
            ),
            20 => 
            array (
                'id' => 21,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 14:27:21',
                'action' => 'create',
                'type' => 'product_categories',
                'type_id' => 3,
                'detail' => 'eyJmaWVsZHMiOlsicGFyZW50X2lkIiwibmFtZSIsInNsdWciLCJpbWFnZSIsImRldGFpbCIsInN0YXR1cyIsImNyZWF0ZWRfYXQiLCJ1cGRhdGVkX2F0Il0sImRhdGEiOnsicGFyZW50X2lkIjoiMSIsIm5hbWUiOiJpUGhvbmUiLCJzbHVnIjoiaXBob25lIiwiaW1hZ2UiOiIiLCJkZXRhaWwiOiIiLCJzdGF0dXMiOiIxIiwiY3JlYXRlZF9hdCI6IjIwMjEtMDctMDUgMTQ6Mjc6MjEiLCJ1cGRhdGVkX2F0IjoiMjAyMS0wNy0wNSAxNDoyNzoyMSJ9fQ==',
            ),
            21 => 
            array (
                'id' => 22,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 14:27:41',
                'action' => 'create',
                'type' => 'product_categories',
                'type_id' => 4,
                'detail' => 'eyJmaWVsZHMiOlsicGFyZW50X2lkIiwibmFtZSIsInNsdWciLCJpbWFnZSIsImRldGFpbCIsInN0YXR1cyIsImNyZWF0ZWRfYXQiLCJ1cGRhdGVkX2F0Il0sImRhdGEiOnsicGFyZW50X2lkIjoiMSIsIm5hbWUiOiJTYW1zdW5nIiwic2x1ZyI6InNhbXN1bmciLCJpbWFnZSI6IiIsImRldGFpbCI6IiIsInN0YXR1cyI6IjEiLCJjcmVhdGVkX2F0IjoiMjAyMS0wNy0wNSAxNDoyNzo0MSIsInVwZGF0ZWRfYXQiOiIyMDIxLTA3LTA1IDE0OjI3OjQxIn19',
            ),
            22 => 
            array (
                'id' => 23,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 14:28:06',
                'action' => 'create',
                'type' => 'product_categories',
                'type_id' => 5,
                'detail' => 'eyJmaWVsZHMiOlsicGFyZW50X2lkIiwibmFtZSIsInNsdWciLCJpbWFnZSIsImRldGFpbCIsInN0YXR1cyIsImNyZWF0ZWRfYXQiLCJ1cGRhdGVkX2F0Il0sImRhdGEiOnsicGFyZW50X2lkIjoiMiIsIm5hbWUiOiJUaFx1MWVkZGkgdHJhbmcgbmFtIiwic2x1ZyI6InRob2ktdHJhbmctbmFtIiwiaW1hZ2UiOiIiLCJkZXRhaWwiOiIiLCJzdGF0dXMiOiIxIiwiY3JlYXRlZF9hdCI6IjIwMjEtMDctMDUgMTQ6Mjg6MDYiLCJ1cGRhdGVkX2F0IjoiMjAyMS0wNy0wNSAxNDoyODowNiJ9fQ==',
            ),
            23 => 
            array (
                'id' => 24,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 14:28:21',
                'action' => 'create',
                'type' => 'product_categories',
                'type_id' => 6,
                'detail' => 'eyJmaWVsZHMiOlsicGFyZW50X2lkIiwibmFtZSIsInNsdWciLCJpbWFnZSIsImRldGFpbCIsInN0YXR1cyIsImNyZWF0ZWRfYXQiLCJ1cGRhdGVkX2F0Il0sImRhdGEiOnsicGFyZW50X2lkIjoiMiIsIm5hbWUiOiJUaFx1MWVkZGkgdHJhbmcgblx1MWVlZiIsInNsdWciOiJ0aG9pLXRyYW5nLW51IiwiaW1hZ2UiOiIiLCJkZXRhaWwiOiIiLCJzdGF0dXMiOiIxIiwiY3JlYXRlZF9hdCI6IjIwMjEtMDctMDUgMTQ6Mjg6MjAiLCJ1cGRhdGVkX2F0IjoiMjAyMS0wNy0wNSAxNDoyODoyMCJ9fQ==',
            ),
            24 => 
            array (
                'id' => 25,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 14:29:54',
                'action' => 'create',
                'type' => 'products',
                'type_id' => 1,
                'detail' => 'eyJmaWVsZHMiOlsiYnJhbmRfaWQiLCJza3UiLCJuYW1lIiwic2x1ZyIsImltYWdlIiwic2xpZGUiLCJwcmljZSIsInByaWNlX29sZCIsImRldGFpbCIsInJlbGF0ZWRfcHJvZHVjdHMiLCJxdWFudGl0eSIsImxlbmd0aCIsIndpZGUiLCJoZWlnaHQiLCJ3ZWlnaHQiLCJzdGF0dXMiLCJjcmVhdGVkX2F0IiwidXBkYXRlZF9hdCJdLCJkYXRhIjp7ImJyYW5kX2lkIjoiMSIsInNrdSI6IiIsIm5hbWUiOiJpUGhvbmUgMTEgUHJvIE1heCA2NEdCIFF1XHUxZWQxYyBUXHUxZWJmIiwic2x1ZyI6ImlwaG9uZS0xMS1wcm8tbWF4LTY0Z2ItcXVvYy10ZSIsImltYWdlIjoiIiwic2xpZGUiOiIiLCJwcmljZSI6IjE4MDAwMDAwIiwicHJpY2Vfb2xkIjoiMjIwMDAwMDAiLCJkZXRhaWwiOiIiLCJyZWxhdGVkX3Byb2R1Y3RzIjoiIiwicXVhbnRpdHkiOiIwIiwibGVuZ3RoIjoiMCIsIndpZGUiOiIwIiwiaGVpZ2h0IjoiMCIsIndlaWdodCI6IjAiLCJzdGF0dXMiOiIxIiwiY3JlYXRlZF9hdCI6IjIwMjEtMDctMDUgMTQ6Mjk6NTQiLCJ1cGRhdGVkX2F0IjoiMjAyMS0wNy0wNSAxNDoyOTo1NCJ9fQ==',
            ),
            25 => 
            array (
                'id' => 26,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 14:31:12',
                'action' => 'update',
                'type' => 'products',
                'type_id' => 1,
                'detail' => 'eyJmaWVsZHMiOlsiYnJhbmRfaWQiLCJza3UiLCJuYW1lIiwic2x1ZyIsImltYWdlIiwic2xpZGUiLCJwcmljZSIsInByaWNlX29sZCIsImRldGFpbCIsInJlbGF0ZWRfcHJvZHVjdHMiLCJxdWFudGl0eSIsImxlbmd0aCIsIndpZGUiLCJoZWlnaHQiLCJ3ZWlnaHQiLCJzdGF0dXMiLCJ1cGRhdGVkX2F0Il0sIm9sZCI6eyJicmFuZF9pZCI6IjEiLCJza3UiOiIiLCJuYW1lIjoiaVBob25lIDExIFBybyBNYXggNjRHQiBRdVx1MWVkMWMgVFx1MWViZiIsInNsdWciOiJpcGhvbmUtMTEtcHJvLW1heC02NGdiLXF1b2MtdGUiLCJpbWFnZSI6IiIsInNsaWRlIjoiIiwicHJpY2UiOiIxODAwMDAwMCIsInByaWNlX29sZCI6IjIyMDAwMDAwIiwiZGV0YWlsIjoiIiwicmVsYXRlZF9wcm9kdWN0cyI6IiIsInF1YW50aXR5IjoiMCIsImxlbmd0aCI6IjAiLCJ3aWRlIjoiMCIsImhlaWdodCI6IjAiLCJ3ZWlnaHQiOiIwIiwic3RhdHVzIjoiMSIsInVwZGF0ZWRfYXQiOiIyMDIxLTA3LTA1IDE0OjI5OjU0In0sIm5ldyI6eyJicmFuZF9pZCI6IjEiLCJza3UiOiIiLCJuYW1lIjoiaVBob25lIDExIFBybyBNYXggNjRHQiBRdVx1MWVkMWMgVFx1MWViZiIsInNsdWciOiJpcGhvbmUtMTEtcHJvLW1heC02NGdiLXF1b2MtdGUiLCJpbWFnZSI6Imh0dHBzOlwvXC9leGFtcGxlLnN1ZG9zcGFjZXMuY29tXC9jb3JlXC8yMDIxXC8wN1wvaXBob25lLTExLXByby1tYXgtdHJhLW5nLTVlY2UyNGZmNWYxMzUtMjctMDUtMjAyMC0xNS0yOS01MS01ZWY3MTVhZGEzNmY4LTI3LTA2LTIwMjAtMTYtNDctMjUtMi5wbmciLCJzbGlkZSI6IiIsInByaWNlIjoiMTgwMDAwMDAiLCJwcmljZV9vbGQiOiIyMjAwMDAwMCIsImRldGFpbCI6IiIsInJlbGF0ZWRfcHJvZHVjdHMiOiIiLCJxdWFudGl0eSI6IjAiLCJsZW5ndGgiOiIwIiwid2lkZSI6IjAiLCJoZWlnaHQiOiIwIiwid2VpZ2h0IjoiMCIsInN0YXR1cyI6IjEiLCJ1cGRhdGVkX2F0IjoiMjAyMS0wNy0wNSAxNDozMToxMiJ9fQ==',
            ),
            26 => 
            array (
                'id' => 27,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 14:33:22',
                'action' => 'create',
                'type' => 'products',
                'type_id' => 2,
                'detail' => 'eyJmaWVsZHMiOlsiYnJhbmRfaWQiLCJza3UiLCJuYW1lIiwic2x1ZyIsImltYWdlIiwic2xpZGUiLCJwcmljZSIsInByaWNlX29sZCIsImRldGFpbCIsInJlbGF0ZWRfcHJvZHVjdHMiLCJxdWFudGl0eSIsImxlbmd0aCIsIndpZGUiLCJoZWlnaHQiLCJ3ZWlnaHQiLCJzdGF0dXMiLCJjcmVhdGVkX2F0IiwidXBkYXRlZF9hdCJdLCJkYXRhIjp7ImJyYW5kX2lkIjoiMSIsInNrdSI6IiIsIm5hbWUiOiJpUGhvbmUgWHMgMjU2R0IgUXVcdTFlZDFjIFRcdTFlYmYgKFx1MDExMFx1MWViOXAgOTklKSIsInNsdWciOiJpcGhvbmUteHMtMjU2Z2ItcXVvYy10ZS1kZXAtOTkiLCJpbWFnZSI6Imh0dHBzOlwvXC9leGFtcGxlLnN1ZG9zcGFjZXMuY29tXC9jb3JlXC8yMDIxXC8wN1wvaXBob25lLXhzLTAxLTVlZGY0MmUwYjFlMWUtMDktMDYtMjAyMC0xNS0wNS01Mi5wbmciLCJzbGlkZSI6IiIsInByaWNlIjoiMTAwMDAwMDAiLCJwcmljZV9vbGQiOiIxMjAwMDAwMCIsImRldGFpbCI6IiIsInJlbGF0ZWRfcHJvZHVjdHMiOiIiLCJxdWFudGl0eSI6IjEwIiwibGVuZ3RoIjoiMCIsIndpZGUiOiIwIiwiaGVpZ2h0IjoiMCIsIndlaWdodCI6IjAiLCJzdGF0dXMiOiIxIiwiY3JlYXRlZF9hdCI6IjIwMjEtMDctMDUgMTQ6MzM6MjEiLCJ1cGRhdGVkX2F0IjoiMjAyMS0wNy0wNSAxNDozMzoyMSJ9fQ==',
            ),
            27 => 
            array (
                'id' => 28,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 14:33:50',
                'action' => 'update',
                'type' => 'products',
                'type_id' => 2,
                'detail' => 'eyJmaWVsZHMiOlsiYnJhbmRfaWQiLCJza3UiLCJuYW1lIiwic2x1ZyIsImltYWdlIiwic2xpZGUiLCJwcmljZSIsInByaWNlX29sZCIsImRldGFpbCIsInJlbGF0ZWRfcHJvZHVjdHMiLCJxdWFudGl0eSIsImxlbmd0aCIsIndpZGUiLCJoZWlnaHQiLCJ3ZWlnaHQiLCJzdGF0dXMiLCJ1cGRhdGVkX2F0Il0sIm9sZCI6eyJicmFuZF9pZCI6IjEiLCJza3UiOiIiLCJuYW1lIjoiaVBob25lIFhzIDI1NkdCIFF1XHUxZWQxYyBUXHUxZWJmIChcdTAxMTBcdTFlYjlwIDk5JSkiLCJzbHVnIjoiaXBob25lLXhzLTI1NmdiLXF1b2MtdGUtZGVwLTk5IiwiaW1hZ2UiOiJodHRwczpcL1wvZXhhbXBsZS5zdWRvc3BhY2VzLmNvbVwvY29yZVwvMjAyMVwvMDdcL2lwaG9uZS14cy0wMS01ZWRmNDJlMGIxZTFlLTA5LTA2LTIwMjAtMTUtMDUtNTIucG5nIiwic2xpZGUiOiIiLCJwcmljZSI6IjEwMDAwMDAwIiwicHJpY2Vfb2xkIjoiMTIwMDAwMDAiLCJkZXRhaWwiOiIiLCJyZWxhdGVkX3Byb2R1Y3RzIjoiIiwicXVhbnRpdHkiOiIxMCIsImxlbmd0aCI6IjAiLCJ3aWRlIjoiMCIsImhlaWdodCI6IjAiLCJ3ZWlnaHQiOiIwIiwic3RhdHVzIjoiMSIsInVwZGF0ZWRfYXQiOiIyMDIxLTA3LTA1IDE0OjMzOjIxIn0sIm5ldyI6eyJicmFuZF9pZCI6IjEiLCJza3UiOiIiLCJuYW1lIjoiaVBob25lIFhzIDI1NkdCIFF1XHUxZWQxYyBUXHUxZWJmIChcdTAxMTBcdTFlYjlwIDk5JSkiLCJzbHVnIjoiaXBob25lLXhzLTI1NmdiLXF1b2MtdGUtZGVwLTk5IiwiaW1hZ2UiOiJodHRwczpcL1wvZXhhbXBsZS5zdWRvc3BhY2VzLmNvbVwvY29yZVwvMjAyMVwvMDdcL2lwaG9uZS14cy0wMS01ZWRmNDJlMGIxZTFlLTA5LTA2LTIwMjAtMTUtMDUtNTIucG5nIiwic2xpZGUiOiIiLCJwcmljZSI6IjEwMDAwMDAwIiwicHJpY2Vfb2xkIjoiMTIwMDAwMDAiLCJkZXRhaWwiOiIiLCJyZWxhdGVkX3Byb2R1Y3RzIjoiIiwicXVhbnRpdHkiOiIwIiwibGVuZ3RoIjoiMCIsIndpZGUiOiIwIiwiaGVpZ2h0IjoiMCIsIndlaWdodCI6IjAiLCJzdGF0dXMiOiIxIiwidXBkYXRlZF9hdCI6IjIwMjEtMDctMDUgMTQ6MzM6NTAifX0=',
            ),
            28 => 
            array (
                'id' => 29,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 14:35:04',
                'action' => 'create',
                'type' => 'products',
                'type_id' => 3,
                'detail' => 'eyJmaWVsZHMiOlsiYnJhbmRfaWQiLCJza3UiLCJuYW1lIiwic2x1ZyIsImltYWdlIiwic2xpZGUiLCJwcmljZSIsInByaWNlX29sZCIsImRldGFpbCIsInJlbGF0ZWRfcHJvZHVjdHMiLCJxdWFudGl0eSIsImxlbmd0aCIsIndpZGUiLCJoZWlnaHQiLCJ3ZWlnaHQiLCJzdGF0dXMiLCJjcmVhdGVkX2F0IiwidXBkYXRlZF9hdCJdLCJkYXRhIjp7ImJyYW5kX2lkIjoiMCIsInNrdSI6IiIsIm5hbWUiOiJpUGhvbmUgMTEgUHJvIE1heCAyNTZHQiBRdVx1MWVkMWMgVFx1MWViZiAoXHUwMTEwXHUxZWI5cCA5OSUpIiwic2x1ZyI6ImlwaG9uZS0xMS1wcm8tbWF4LTI1NmdiLXF1b2MtdGUtZGVwLTk5IiwiaW1hZ2UiOiJodHRwczpcL1wvZXhhbXBsZS5zdWRvc3BhY2VzLmNvbVwvY29yZVwvMjAyMVwvMDdcL2lwaG9uZS0xMS1wcm8tbWF4LWRlbi01ZWRkZTdmMTgwYTEwLTA4LTA2LTIwMjAtMTQtMjUtMzcucG5nIiwic2xpZGUiOiIiLCJwcmljZSI6IjIyMDAwMDAwIiwicHJpY2Vfb2xkIjoiMjUwMDAwMDAiLCJkZXRhaWwiOiIiLCJyZWxhdGVkX3Byb2R1Y3RzIjoiIiwicXVhbnRpdHkiOiIyNSIsImxlbmd0aCI6IjAiLCJ3aWRlIjoiMCIsImhlaWdodCI6IjAiLCJ3ZWlnaHQiOiIwIiwic3RhdHVzIjoiMSIsImNyZWF0ZWRfYXQiOiIyMDIxLTA3LTA1IDE0OjM1OjA0IiwidXBkYXRlZF9hdCI6IjIwMjEtMDctMDUgMTQ6MzU6MDQifX0=',
            ),
            29 => 
            array (
                'id' => 30,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 14:35:28',
                'action' => 'update',
                'type' => 'products',
                'type_id' => 3,
                'detail' => 'eyJmaWVsZHMiOlsiYnJhbmRfaWQiLCJza3UiLCJuYW1lIiwic2x1ZyIsImltYWdlIiwic2xpZGUiLCJwcmljZSIsInByaWNlX29sZCIsImRldGFpbCIsInJlbGF0ZWRfcHJvZHVjdHMiLCJxdWFudGl0eSIsImxlbmd0aCIsIndpZGUiLCJoZWlnaHQiLCJ3ZWlnaHQiLCJzdGF0dXMiLCJ1cGRhdGVkX2F0Il0sIm9sZCI6eyJicmFuZF9pZCI6IjAiLCJza3UiOiIiLCJuYW1lIjoiaVBob25lIDExIFBybyBNYXggMjU2R0IgUXVcdTFlZDFjIFRcdTFlYmYgKFx1MDExMFx1MWViOXAgOTklKSIsInNsdWciOiJpcGhvbmUtMTEtcHJvLW1heC0yNTZnYi1xdW9jLXRlLWRlcC05OSIsImltYWdlIjoiaHR0cHM6XC9cL2V4YW1wbGUuc3Vkb3NwYWNlcy5jb21cL2NvcmVcLzIwMjFcLzA3XC9pcGhvbmUtMTEtcHJvLW1heC1kZW4tNWVkZGU3ZjE4MGExMC0wOC0wNi0yMDIwLTE0LTI1LTM3LnBuZyIsInNsaWRlIjoiIiwicHJpY2UiOiIyMjAwMDAwMCIsInByaWNlX29sZCI6IjI1MDAwMDAwIiwiZGV0YWlsIjoiIiwicmVsYXRlZF9wcm9kdWN0cyI6IiIsInF1YW50aXR5IjoiMjUiLCJsZW5ndGgiOiIwIiwid2lkZSI6IjAiLCJoZWlnaHQiOiIwIiwid2VpZ2h0IjoiMCIsInN0YXR1cyI6IjEiLCJ1cGRhdGVkX2F0IjoiMjAyMS0wNy0wNSAxNDozNTowNCJ9LCJuZXciOnsiYnJhbmRfaWQiOiIwIiwic2t1IjoiIiwibmFtZSI6ImlQaG9uZSAxMSBQcm8gTWF4IDI1NkdCIFF1XHUxZWQxYyBUXHUxZWJmIChcdTAxMTBcdTFlYjlwIDk5JSkiLCJzbHVnIjoiaXBob25lLTExLXByby1tYXgtMjU2Z2ItcXVvYy10ZS1kZXAtOTkiLCJpbWFnZSI6Imh0dHBzOlwvXC9leGFtcGxlLnN1ZG9zcGFjZXMuY29tXC9jb3JlXC8yMDIxXC8wN1wvaXBob25lLTExLXByby1tYXgtZGVuLTVlZGRlN2YxODBhMTAtMDgtMDYtMjAyMC0xNC0yNS0zNy5wbmciLCJzbGlkZSI6IiIsInByaWNlIjoiMjIwMDAwMDAiLCJwcmljZV9vbGQiOiIyNTAwMDAwMCIsImRldGFpbCI6IiIsInJlbGF0ZWRfcHJvZHVjdHMiOiIiLCJxdWFudGl0eSI6IjAiLCJsZW5ndGgiOiIwIiwid2lkZSI6IjAiLCJoZWlnaHQiOiIwIiwid2VpZ2h0IjoiMCIsInN0YXR1cyI6IjEiLCJ1cGRhdGVkX2F0IjoiMjAyMS0wNy0wNSAxNDozNToyOCJ9fQ==',
            ),
            30 => 
            array (
                'id' => 31,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 14:35:39',
                'action' => 'update',
                'type' => 'products',
                'type_id' => 3,
                'detail' => 'eyJmaWVsZHMiOlsiYnJhbmRfaWQiLCJza3UiLCJuYW1lIiwic2x1ZyIsImltYWdlIiwic2xpZGUiLCJwcmljZSIsInByaWNlX29sZCIsImRldGFpbCIsInJlbGF0ZWRfcHJvZHVjdHMiLCJxdWFudGl0eSIsImxlbmd0aCIsIndpZGUiLCJoZWlnaHQiLCJ3ZWlnaHQiLCJzdGF0dXMiLCJ1cGRhdGVkX2F0Il0sIm9sZCI6eyJicmFuZF9pZCI6IjAiLCJza3UiOiIiLCJuYW1lIjoiaVBob25lIDExIFBybyBNYXggMjU2R0IgUXVcdTFlZDFjIFRcdTFlYmYgKFx1MDExMFx1MWViOXAgOTklKSIsInNsdWciOiJpcGhvbmUtMTEtcHJvLW1heC0yNTZnYi1xdW9jLXRlLWRlcC05OSIsImltYWdlIjoiaHR0cHM6XC9cL2V4YW1wbGUuc3Vkb3NwYWNlcy5jb21cL2NvcmVcLzIwMjFcLzA3XC9pcGhvbmUtMTEtcHJvLW1heC1kZW4tNWVkZGU3ZjE4MGExMC0wOC0wNi0yMDIwLTE0LTI1LTM3LnBuZyIsInNsaWRlIjoiIiwicHJpY2UiOiIyMjAwMDAwMCIsInByaWNlX29sZCI6IjI1MDAwMDAwIiwiZGV0YWlsIjoiIiwicmVsYXRlZF9wcm9kdWN0cyI6IiIsInF1YW50aXR5IjoiMCIsImxlbmd0aCI6IjAiLCJ3aWRlIjoiMCIsImhlaWdodCI6IjAiLCJ3ZWlnaHQiOiIwIiwic3RhdHVzIjoiMSIsInVwZGF0ZWRfYXQiOiIyMDIxLTA3LTA1IDE0OjM1OjI4In0sIm5ldyI6eyJicmFuZF9pZCI6IjEiLCJza3UiOiIiLCJuYW1lIjoiaVBob25lIDExIFBybyBNYXggMjU2R0IgUXVcdTFlZDFjIFRcdTFlYmYgKFx1MDExMFx1MWViOXAgOTklKSIsInNsdWciOiJpcGhvbmUtMTEtcHJvLW1heC0yNTZnYi1xdW9jLXRlLWRlcC05OSIsImltYWdlIjoiaHR0cHM6XC9cL2V4YW1wbGUuc3Vkb3NwYWNlcy5jb21cL2NvcmVcLzIwMjFcLzA3XC9pcGhvbmUtMTEtcHJvLW1heC1kZW4tNWVkZGU3ZjE4MGExMC0wOC0wNi0yMDIwLTE0LTI1LTM3LnBuZyIsInNsaWRlIjoiIiwicHJpY2UiOiIyMjAwMDAwMCIsInByaWNlX29sZCI6IjI1MDAwMDAwIiwiZGV0YWlsIjoiIiwicmVsYXRlZF9wcm9kdWN0cyI6IiIsInF1YW50aXR5IjoiMCIsImxlbmd0aCI6IjAiLCJ3aWRlIjoiMCIsImhlaWdodCI6IjAiLCJ3ZWlnaHQiOiIwIiwic3RhdHVzIjoiMSIsInVwZGF0ZWRfYXQiOiIyMDIxLTA3LTA1IDE0OjM1OjM5In19',
            ),
            31 => 
            array (
                'id' => 32,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 14:36:45',
                'action' => 'create',
                'type' => 'products',
                'type_id' => 4,
                'detail' => 'eyJmaWVsZHMiOlsiYnJhbmRfaWQiLCJza3UiLCJuYW1lIiwic2x1ZyIsImltYWdlIiwic2xpZGUiLCJwcmljZSIsInByaWNlX29sZCIsImRldGFpbCIsInJlbGF0ZWRfcHJvZHVjdHMiLCJxdWFudGl0eSIsImxlbmd0aCIsIndpZGUiLCJoZWlnaHQiLCJ3ZWlnaHQiLCJzdGF0dXMiLCJjcmVhdGVkX2F0IiwidXBkYXRlZF9hdCJdLCJkYXRhIjp7ImJyYW5kX2lkIjoiMCIsInNrdSI6IiIsIm5hbWUiOiJcdTAwYzFvIHNcdTAxYTEgbWkgbmFtIiwic2x1ZyI6ImFvLXNvLW1pLW5hbSIsImltYWdlIjoiIiwic2xpZGUiOiIiLCJwcmljZSI6IjMwMDAwMCIsInByaWNlX29sZCI6IjUwMDAwMCIsImRldGFpbCI6IiIsInJlbGF0ZWRfcHJvZHVjdHMiOiIiLCJxdWFudGl0eSI6IjEwMCIsImxlbmd0aCI6IjAiLCJ3aWRlIjoiMCIsImhlaWdodCI6IjAiLCJ3ZWlnaHQiOiIwIiwic3RhdHVzIjoiMSIsImNyZWF0ZWRfYXQiOiIyMDIxLTA3LTA1IDE0OjM2OjQ0IiwidXBkYXRlZF9hdCI6IjIwMjEtMDctMDUgMTQ6MzY6NDQifX0=',
            ),
            32 => 
            array (
                'id' => 33,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 14:37:32',
                'action' => 'update',
                'type' => 'products',
                'type_id' => 4,
                'detail' => 'eyJmaWVsZHMiOlsiYnJhbmRfaWQiLCJza3UiLCJuYW1lIiwic2x1ZyIsImltYWdlIiwic2xpZGUiLCJwcmljZSIsInByaWNlX29sZCIsImRldGFpbCIsInJlbGF0ZWRfcHJvZHVjdHMiLCJxdWFudGl0eSIsImxlbmd0aCIsIndpZGUiLCJoZWlnaHQiLCJ3ZWlnaHQiLCJzdGF0dXMiLCJ1cGRhdGVkX2F0Il0sIm9sZCI6eyJicmFuZF9pZCI6IjAiLCJza3UiOiIiLCJuYW1lIjoiXHUwMGMxbyBzXHUwMWExIG1pIG5hbSIsInNsdWciOiJhby1zby1taS1uYW0iLCJpbWFnZSI6IiIsInNsaWRlIjoiIiwicHJpY2UiOiIzMDAwMDAiLCJwcmljZV9vbGQiOiI1MDAwMDAiLCJkZXRhaWwiOiIiLCJyZWxhdGVkX3Byb2R1Y3RzIjoiIiwicXVhbnRpdHkiOiIxMDAiLCJsZW5ndGgiOiIwIiwid2lkZSI6IjAiLCJoZWlnaHQiOiIwIiwid2VpZ2h0IjoiMCIsInN0YXR1cyI6IjEiLCJ1cGRhdGVkX2F0IjoiMjAyMS0wNy0wNSAxNDozNjo0NCJ9LCJuZXciOnsiYnJhbmRfaWQiOiIwIiwic2t1IjoiIiwibmFtZSI6Ilx1MDBjMW8gc1x1MDFhMSBtaSBuYW0iLCJzbHVnIjoiYW8tc28tbWktbmFtIiwiaW1hZ2UiOiIiLCJzbGlkZSI6IiIsInByaWNlIjoiMzAwMDAwIiwicHJpY2Vfb2xkIjoiNTAwMDAwIiwiZGV0YWlsIjoiIiwicmVsYXRlZF9wcm9kdWN0cyI6IiIsInF1YW50aXR5IjoiMCIsImxlbmd0aCI6IjAiLCJ3aWRlIjoiMCIsImhlaWdodCI6IjAiLCJ3ZWlnaHQiOiIwIiwic3RhdHVzIjoiMSIsInVwZGF0ZWRfYXQiOiIyMDIxLTA3LTA1IDE0OjM3OjMyIn19',
            ),
            33 => 
            array (
                'id' => 34,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 14:39:13',
                'action' => 'update',
                'type' => 'products',
                'type_id' => 4,
                'detail' => 'eyJmaWVsZHMiOlsiYnJhbmRfaWQiLCJza3UiLCJuYW1lIiwic2x1ZyIsImltYWdlIiwic2xpZGUiLCJwcmljZSIsInByaWNlX29sZCIsImRldGFpbCIsInJlbGF0ZWRfcHJvZHVjdHMiLCJxdWFudGl0eSIsImxlbmd0aCIsIndpZGUiLCJoZWlnaHQiLCJ3ZWlnaHQiLCJzdGF0dXMiLCJ1cGRhdGVkX2F0Il0sIm9sZCI6eyJicmFuZF9pZCI6IjAiLCJza3UiOiIiLCJuYW1lIjoiXHUwMGMxbyBzXHUwMWExIG1pIG5hbSIsInNsdWciOiJhby1zby1taS1uYW0iLCJpbWFnZSI6IiIsInNsaWRlIjoiIiwicHJpY2UiOiIzMDAwMDAiLCJwcmljZV9vbGQiOiI1MDAwMDAiLCJkZXRhaWwiOiIiLCJyZWxhdGVkX3Byb2R1Y3RzIjoiIiwicXVhbnRpdHkiOiIwIiwibGVuZ3RoIjoiMCIsIndpZGUiOiIwIiwiaGVpZ2h0IjoiMCIsIndlaWdodCI6IjAiLCJzdGF0dXMiOiIxIiwidXBkYXRlZF9hdCI6IjIwMjEtMDctMDUgMTQ6Mzc6MzIifSwibmV3Ijp7ImJyYW5kX2lkIjoiMCIsInNrdSI6IiIsIm5hbWUiOiJcdTAwYzFvIHNcdTAxYTEgbWkgbmFtIiwic2x1ZyI6ImFvLXNvLW1pLW5hbSIsImltYWdlIjoiaHR0cHM6XC9cL2V4YW1wbGUuc3Vkb3NwYWNlcy5jb21cL2NvcmVcLzIwMjFcLzA3XC9hby1zby1taS1uYW0tYXJpc3Rpbm8tYWxzMTMwMDEtMDF4NTAweDUwMHg0LmpwZWciLCJzbGlkZSI6IiIsInByaWNlIjoiMzAwMDAwIiwicHJpY2Vfb2xkIjoiNTAwMDAwIiwiZGV0YWlsIjoiIiwicmVsYXRlZF9wcm9kdWN0cyI6IiIsInF1YW50aXR5IjoiMCIsImxlbmd0aCI6IjAiLCJ3aWRlIjoiMCIsImhlaWdodCI6IjAiLCJ3ZWlnaHQiOiIwIiwic3RhdHVzIjoiMSIsInVwZGF0ZWRfYXQiOiIyMDIxLTA3LTA1IDE0OjM5OjEzIn19',
            ),
            34 => 
            array (
                'id' => 35,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 14:40:02',
                'action' => 'create',
                'type' => 'products',
                'type_id' => 5,
                'detail' => 'eyJmaWVsZHMiOlsiYnJhbmRfaWQiLCJza3UiLCJuYW1lIiwic2x1ZyIsImltYWdlIiwic2xpZGUiLCJwcmljZSIsInByaWNlX29sZCIsImRldGFpbCIsInJlbGF0ZWRfcHJvZHVjdHMiLCJxdWFudGl0eSIsImxlbmd0aCIsIndpZGUiLCJoZWlnaHQiLCJ3ZWlnaHQiLCJzdGF0dXMiLCJjcmVhdGVkX2F0IiwidXBkYXRlZF9hdCJdLCJkYXRhIjp7ImJyYW5kX2lkIjoiMCIsInNrdSI6IiIsIm5hbWUiOiJcdTAwYzFvIHNcdTAxYTEgbWkgblx1MWVlZiIsInNsdWciOiJhby1zby1taS1udSIsImltYWdlIjoiaHR0cHM6XC9cL2V4YW1wbGUuc3Vkb3NwYWNlcy5jb21cL2NvcmVcLzIwMjFcLzA3XC9hby1zby1taS1uYW0tYXJpc3Rpbm8tYWxzMTMwMDEtMDF4NTAweDUwMHg0LmpwZWciLCJzbGlkZSI6IiIsInByaWNlIjoiNDAwMDAwIiwicHJpY2Vfb2xkIjoiNTAwMDAwIiwiZGV0YWlsIjoiIiwicmVsYXRlZF9wcm9kdWN0cyI6IiIsInF1YW50aXR5IjoiMjAwIiwibGVuZ3RoIjoiMCIsIndpZGUiOiIwIiwiaGVpZ2h0IjoiMCIsIndlaWdodCI6IjAiLCJzdGF0dXMiOiIxIiwiY3JlYXRlZF9hdCI6IjIwMjEtMDctMDUgMTQ6NDA6MDIiLCJ1cGRhdGVkX2F0IjoiMjAyMS0wNy0wNSAxNDo0MDowMiJ9fQ==',
            ),
            35 => 
            array (
                'id' => 36,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 14:41:08',
                'action' => 'update',
                'type' => 'products',
                'type_id' => 5,
                'detail' => 'eyJmaWVsZHMiOlsiYnJhbmRfaWQiLCJza3UiLCJuYW1lIiwic2x1ZyIsImltYWdlIiwic2xpZGUiLCJwcmljZSIsInByaWNlX29sZCIsImRldGFpbCIsInJlbGF0ZWRfcHJvZHVjdHMiLCJxdWFudGl0eSIsImxlbmd0aCIsIndpZGUiLCJoZWlnaHQiLCJ3ZWlnaHQiLCJzdGF0dXMiLCJ1cGRhdGVkX2F0Il0sIm9sZCI6eyJicmFuZF9pZCI6IjAiLCJza3UiOiIiLCJuYW1lIjoiXHUwMGMxbyBzXHUwMWExIG1pIG5cdTFlZWYiLCJzbHVnIjoiYW8tc28tbWktbnUiLCJpbWFnZSI6Imh0dHBzOlwvXC9leGFtcGxlLnN1ZG9zcGFjZXMuY29tXC9jb3JlXC8yMDIxXC8wN1wvYW8tc28tbWktbmFtLWFyaXN0aW5vLWFsczEzMDAxLTAxeDUwMHg1MDB4NC5qcGVnIiwic2xpZGUiOiIiLCJwcmljZSI6IjQwMDAwMCIsInByaWNlX29sZCI6IjUwMDAwMCIsImRldGFpbCI6IiIsInJlbGF0ZWRfcHJvZHVjdHMiOiIiLCJxdWFudGl0eSI6IjIwMCIsImxlbmd0aCI6IjAiLCJ3aWRlIjoiMCIsImhlaWdodCI6IjAiLCJ3ZWlnaHQiOiIwIiwic3RhdHVzIjoiMSIsInVwZGF0ZWRfYXQiOiIyMDIxLTA3LTA1IDE0OjQwOjAyIn0sIm5ldyI6eyJicmFuZF9pZCI6IjAiLCJza3UiOiIiLCJuYW1lIjoiXHUwMGMxbyBzXHUwMWExIG1pIG5cdTFlZWYiLCJzbHVnIjoiYW8tc28tbWktbnUiLCJpbWFnZSI6Imh0dHBzOlwvXC9leGFtcGxlLnN1ZG9zcGFjZXMuY29tXC9jb3JlXC8yMDIxXC8wN1wvYW8tc28tbWktbmFtLWFyaXN0aW5vLWFsczEzMDAxLTAxeDUwMHg1MDB4NC5qcGVnIiwic2xpZGUiOiIiLCJwcmljZSI6IjQwMDAwMCIsInByaWNlX29sZCI6IjUwMDAwMCIsImRldGFpbCI6IiIsInJlbGF0ZWRfcHJvZHVjdHMiOiIiLCJxdWFudGl0eSI6IjAiLCJsZW5ndGgiOiIwIiwid2lkZSI6IjAiLCJoZWlnaHQiOiIwIiwid2VpZ2h0IjoiMCIsInN0YXR1cyI6IjEiLCJ1cGRhdGVkX2F0IjoiMjAyMS0wNy0wNSAxNDo0MTowOCJ9fQ==',
            ),
            36 => 
            array (
                'id' => 37,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 14:41:17',
                'action' => 'quick_update',
                'type' => 'products',
                'type_id' => 5,
                'detail' => 'eyJmaWVsZHMiOlsic3RhdHVzIl0sIm9sZCI6eyJzdGF0dXMiOiIxIn0sIm5ldyI6eyJzdGF0dXMiOiIwIn19',
            ),
            37 => 
            array (
                'id' => 38,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 14:41:18',
                'action' => 'quick_update',
                'type' => 'products',
                'type_id' => 5,
                'detail' => 'eyJmaWVsZHMiOlsic3RhdHVzIl0sIm9sZCI6eyJzdGF0dXMiOiIwIn0sIm5ldyI6eyJzdGF0dXMiOiIxIn19',
            ),
            38 => 
            array (
                'id' => 39,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 15:00:48',
                'action' => 'update',
                'type' => 'admin_users',
                'type_id' => 2,
                'detail' => 'eyJmaWVsZHMiOlsicG9zaXRpb24iLCJkaXNwbGF5X25hbWUiLCJwaG9uZSIsImFkZHJlc3MiLCJiaXJ0aGRheSIsImF2YXRhciIsImluZm9tYXRpb24iLCJzb2NpYWwiLCJjYXBhYmlsaXRpZXMiLCJzdGF0dXMiLCJ1cGRhdGVkX2F0Il0sIm9sZCI6eyJwb3NpdGlvbiI6IiIsImRpc3BsYXlfbmFtZSI6IlN1ZG8gRWNvbW1lcmNlIiwicGhvbmUiOiIiLCJhZGRyZXNzIjoiIiwiYmlydGhkYXkiOiIiLCJhdmF0YXIiOiIiLCJpbmZvbWF0aW9uIjoiIiwic29jaWFsIjoiIiwiY2FwYWJpbGl0aWVzIjoiIiwic3RhdHVzIjoiMSIsInVwZGF0ZWRfYXQiOiIyMDIxLTA3LTA1IDE0OjEyOjIwIn0sIm5ldyI6eyJwb3NpdGlvbiI6IkNFTyIsImRpc3BsYXlfbmFtZSI6IlN1ZG8gRWNvbW1lcmNlIiwicGhvbmUiOiIiLCJhZGRyZXNzIjoiIiwiYmlydGhkYXkiOiIiLCJhdmF0YXIiOiIiLCJpbmZvbWF0aW9uIjoiIiwic29jaWFsIjoie1wic29jaWFsX25hbWVcIjpcIlwiLFwic29jaWFsX2xpbmtcIjpcIlwifSIsImNhcGFiaWxpdGllcyI6IltcIm9uXCIsXCJwcm9kdWN0c19pbmRleFwiLFwicHJvZHVjdHNfY3JlYXRlXCIsXCJwcm9kdWN0c19lZGl0XCIsXCJwcm9kdWN0c19yZXN0b3JlXCIsXCJwcm9kdWN0c19kZWxldGVcIixcIm9uXCIsXCJwcm9kdWN0X2NhdGVnb3JpZXNfaW5kZXhcIixcInByb2R1Y3RfY2F0ZWdvcmllc19jcmVhdGVcIixcInByb2R1Y3RfY2F0ZWdvcmllc19lZGl0XCIsXCJwcm9kdWN0X2NhdGVnb3JpZXNfcmVzdG9yZVwiLFwicHJvZHVjdF9jYXRlZ29yaWVzX2RlbGV0ZVwiLFwib25cIixcImF0dHJpYnV0ZXNfaW5kZXhcIixcImF0dHJpYnV0ZXNfY3JlYXRlXCIsXCJhdHRyaWJ1dGVzX2VkaXRcIixcImF0dHJpYnV0ZXNfcmVzdG9yZVwiLFwiYXR0cmlidXRlc19kZWxldGVcIixcIm9uXCIsXCJicmFuZHNfaW5kZXhcIixcImJyYW5kc19jcmVhdGVcIixcImJyYW5kc19lZGl0XCIsXCJicmFuZHNfcmVzdG9yZVwiLFwiYnJhbmRzX2RlbGV0ZVwiLFwib25cIixcInNsaWRlc19pbmRleFwiLFwic2xpZGVzX2NyZWF0ZVwiLFwic2xpZGVzX2VkaXRcIixcInNsaWRlc19yZXN0b3JlXCIsXCJzbGlkZXNfZGVsZXRlXCIsXCJvblwiLFwib3JkZXJzX2luZGV4XCIsXCJvcmRlcnNfY3JlYXRlXCIsXCJvcmRlcnNfZWRpdFwiLFwib3JkZXJzX3Jlc3RvcmVcIixcIm9yZGVyc19kZWxldGVcIixcIm9uXCIsXCJjdXN0b21lcnNfaW5kZXhcIixcImN1c3RvbWVyc19jcmVhdGVcIixcImN1c3RvbWVyc19lZGl0XCIsXCJjdXN0b21lcnNfcmVzdG9yZVwiLFwiY3VzdG9tZXJzX2RlbGV0ZVwiLFwib25cIixcInNoaXBwaW5nc19pbmRleFwiLFwic2hpcHBpbmdzX2NyZWF0ZVwiLFwic2hpcHBpbmdzX2VkaXRcIixcInNoaXBwaW5nc19yZXN0b3JlXCIsXCJzaGlwcGluZ3NfZGVsZXRlXCIsXCJvblwiLFwidGF4ZXNfaW5kZXhcIixcInRheGVzX2NyZWF0ZVwiLFwidGF4ZXNfZWRpdFwiLFwidGF4ZXNfcmVzdG9yZVwiLFwidGF4ZXNfZGVsZXRlXCIsXCJvblwiLFwicG9zdHNfaW5kZXhcIixcInBvc3RzX2NyZWF0ZVwiLFwicG9zdHNfZWRpdFwiLFwicG9zdHNfcmVzdG9yZVwiLFwicG9zdHNfZGVsZXRlXCIsXCJvblwiLFwicG9zdF9jYXRlZ29yaWVzX2luZGV4XCIsXCJwb3N0X2NhdGVnb3JpZXNfY3JlYXRlXCIsXCJwb3N0X2NhdGVnb3JpZXNfZWRpdFwiLFwicG9zdF9jYXRlZ29yaWVzX3Jlc3RvcmVcIixcInBvc3RfY2F0ZWdvcmllc19kZWxldGVcIixcIm9uXCIsXCJwYWdlc19pbmRleFwiLFwicGFnZXNfY3JlYXRlXCIsXCJwYWdlc19lZGl0XCIsXCJwYWdlc19yZXN0b3JlXCIsXCJwYWdlc19kZWxldGVcIixcIm9uXCIsXCJ0YWdzX2luZGV4XCIsXCJ0YWdzX2NyZWF0ZVwiLFwidGFnc19lZGl0XCIsXCJ0YWdzX3Jlc3RvcmVcIixcInRhZ3NfZGVsZXRlXCIsXCJvblwiLFwic3luY19saW5rc19pbmRleFwiLFwic3luY19saW5rc19jcmVhdGVcIixcInN5bmNfbGlua3NfZWRpdFwiLFwic3luY19saW5rc19yZXN0b3JlXCIsXCJzeW5jX2xpbmtzX2RlbGV0ZVwiLFwib25cIixcImNvbW1lbnRzX2luZGV4XCIsXCJjb21tZW50c19jcmVhdGVcIixcImNvbW1lbnRzX2VkaXRcIixcImNvbW1lbnRzX3Jlc3RvcmVcIixcImNvbW1lbnRzX2RlbGV0ZVwiLFwib25cIixcImNvbnRhY3RzX2luZGV4XCIsXCJjb250YWN0c19lZGl0XCIsXCJjb250YWN0c19yZXN0b3JlXCIsXCJjb250YWN0c19kZWxldGVcIixcIm9uXCIsXCJlbWFpbF9yZWdpc3RlcnNfaW5kZXhcIixcImVtYWlsX3JlZ2lzdGVyc19lZGl0XCIsXCJlbWFpbF9yZWdpc3RlcnNfcmVzdG9yZVwiLFwiZW1haWxfcmVnaXN0ZXJzX2RlbGV0ZVwiLFwib25cIixcImNhbGxfbWVfYmFja19pbmRleFwiLFwiY2FsbF9tZV9iYWNrX2NyZWF0ZVwiLFwiY2FsbF9tZV9iYWNrX2VkaXRcIixcImNhbGxfbWVfYmFja19yZXN0b3JlXCIsXCJjYWxsX21lX2JhY2tfZGVsZXRlXCIsXCJvblwiLFwiYWRtaW5fdXNlcnNfaW5kZXhcIixcImFkbWluX3VzZXJzX2NyZWF0ZVwiLFwiYWRtaW5fdXNlcnNfZWRpdFwiLFwiYWRtaW5fdXNlcnNfcmVzdG9yZVwiLFwiYWRtaW5fdXNlcnNfZGVsZXRlXCIsXCJvblwiLFwic2V0dGluZ3NfZ2VuZXJhbFwiLFwic2V0dGluZ3NfaG9tZVwiLFwic2V0dGluZ3NfbWVudVwiLFwic2V0dGluZ3NfY29udGFjdFwiLFwic2V0dGluZ3Nfb3ZlcnZpZXdcIixcIm9uXCIsXCJtZWRpYV9pbmRleFwiLFwib25cIixcInN5c3RlbV9sb2dzX2luZGV4XCIsXCJzeXN0ZW1fbG9nc19zaG93XCJdIiwic3RhdHVzIjoiMSIsInVwZGF0ZWRfYXQiOiIyMDIxLTA3LTA1IDE1OjAwOjQ4In19',
            ),
            39 => 
            array (
                'id' => 40,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 15:02:35',
                'action' => 'create',
                'type' => 'tags',
                'type_id' => 1,
                'detail' => 'eyJmaWVsZHMiOlsibmFtZSIsInNsdWciLCJkZXRhaWwiLCJzdGF0dXMiLCJjcmVhdGVkX2F0IiwidXBkYXRlZF9hdCJdLCJkYXRhIjp7Im5hbWUiOiJpUGhvbmUiLCJzbHVnIjoiaXBob25lIiwiZGV0YWlsIjoiIiwic3RhdHVzIjoiMSIsImNyZWF0ZWRfYXQiOiIyMDIxLTA3LTA1IDE1OjAyOjM1IiwidXBkYXRlZF9hdCI6IjIwMjEtMDctMDUgMTU6MDI6MzUifX0=',
            ),
            40 => 
            array (
                'id' => 41,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 15:02:59',
                'action' => 'create',
                'type' => 'tags',
                'type_id' => 2,
                'detail' => 'eyJmaWVsZHMiOlsibmFtZSIsInNsdWciLCJkZXRhaWwiLCJzdGF0dXMiLCJjcmVhdGVkX2F0IiwidXBkYXRlZF9hdCJdLCJkYXRhIjp7Im5hbWUiOiJpUGhvbmUgMTEiLCJzbHVnIjoiaXBob25lLTExIiwiZGV0YWlsIjoiIiwic3RhdHVzIjoiMSIsImNyZWF0ZWRfYXQiOiIyMDIxLTA3LTA1IDE1OjAyOjU4IiwidXBkYXRlZF9hdCI6IjIwMjEtMDctMDUgMTU6MDI6NTgifX0=',
            ),
            41 => 
            array (
                'id' => 42,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 15:03:08',
                'action' => 'create',
                'type' => 'tags',
                'type_id' => 3,
                'detail' => 'eyJmaWVsZHMiOlsibmFtZSIsInNsdWciLCJkZXRhaWwiLCJzdGF0dXMiLCJjcmVhdGVkX2F0IiwidXBkYXRlZF9hdCJdLCJkYXRhIjp7Im5hbWUiOiJpUGhvbmUgMTIiLCJzbHVnIjoiaXBob25lLTEyIiwiZGV0YWlsIjoiIiwic3RhdHVzIjoiMSIsImNyZWF0ZWRfYXQiOiIyMDIxLTA3LTA1IDE1OjAzOjA4IiwidXBkYXRlZF9hdCI6IjIwMjEtMDctMDUgMTU6MDM6MDgifX0=',
            ),
            42 => 
            array (
                'id' => 43,
                'admin_id' => 1,
                'ip' => '172.29.0.1',
                'time' => '2021-07-05 15:03:33',
                'action' => 'create',
                'type' => 'sync_links',
                'type_id' => 1,
                'detail' => 'eyJmaWVsZHMiOlsib2xkIiwibmV3IiwiY29kZSIsInN0YXR1cyJdLCJkYXRhIjp7Im9sZCI6IlwvaXBob25lMTEiLCJuZXciOiJcL2lwaG9uZS0xMSIsImNvZGUiOiIzMDEiLCJzdGF0dXMiOiIxIn19',
            ),
        ));
        
        
    }
}