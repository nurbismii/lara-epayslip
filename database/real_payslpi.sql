-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2022 at 07:36 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `real_payslpi`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_karyawans`
--

CREATE TABLE `data_karyawans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_ktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `nm_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `npwp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bpjs_ket` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bpjs_tk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vaksin_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vaksin_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_join` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_karyawans`
--

INSERT INTO `data_karyawans` (`id`, `nik`, `no_ktp`, `nama`, `tgl_lahir`, `nm_perusahaan`, `created_at`, `updated_at`, `npwp`, `bpjs_ket`, `bpjs_tk`, `vaksin_1`, `vaksin_2`, `tgl_join`) VALUES
(165702, '18043966', '7402201708870004', 'DARSIAWAN', '1987-08-17', 'VDNIP', '2022-01-20 02:07:42', '2022-01-20 02:07:42', '429401425811000', '222222221', '1111111111', 'YA', 'YA', '2020-11-09'),
(165703, '18043967', '7409010911920001', 'WILLIAM HENDRIONO', '1992-11-09', 'VDNIP', '2022-01-20 02:07:42', '2022-01-20 02:07:42', '429826159811000', '222222222', '1111111112', 'YA', 'TIDAK', '2020-11-09'),
(165704, '18043968', '7402050103930002', 'DANI RAMADHAN', '1993-03-01', 'VDNIP', '2022-01-20 02:07:42', '2022-01-20 02:07:42', '966341745811000', '222222223', '1111111113', 'TIDAK', 'TIDAK', '2020-11-10');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(1, '71fbe5d3-67ce-48bc-a52f-0fc60606166c', 'database', 'default', '{\"uuid\":\"71fbe5d3-67ce-48bc-a52f-0fc60606166c\",\"displayName\":\"App\\\\Jobs\\\\ImportJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\ImportJob\",\"command\":\"O:18:\\\"App\\\\Jobs\\\\ImportJob\\\":10:{s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'ErrorException: Undefined property: App\\Jobs\\ImportJob::$file in D:\\DATA E\\web\\htdocs\\PaySlip\\app\\Jobs\\ImportJob.php:35\nStack trace:\n#0 D:\\DATA E\\web\\htdocs\\PaySlip\\app\\Jobs\\ImportJob.php(35): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(8, \'Undefined prope...\', \'D:\\\\DATA E\\\\web\\\\h...\', 35, Array)\n#1 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): App\\Jobs\\ImportJob->handle()\n#2 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#3 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#4 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#5 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(651): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#6 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(128): Illuminate\\Container\\Container->call(Array)\n#7 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\ImportJob))\n#8 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\ImportJob))\n#9 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#10 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(120): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\ImportJob), false)\n#11 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\ImportJob))\n#12 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\ImportJob))\n#13 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#14 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\ImportJob))\n#15 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#16 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(428): Illuminate\\Queue\\Jobs\\Job->fire()\n#17 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(378): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#18 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(172): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#19 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(117): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#20 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(101): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#21 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#22 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#23 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#24 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#25 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(651): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#26 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(136): Illuminate\\Container\\Container->call(Array)\n#27 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\symfony\\console\\Command\\Command.php(299): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#28 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#29 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\symfony\\console\\Application.php(978): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#30 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\symfony\\console\\Application.php(295): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#31 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\symfony\\console\\Application.php(167): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#32 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php(92): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#33 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#34 D:\\DATA E\\web\\htdocs\\PaySlip\\artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#35 {main}', '2021-09-12 22:26:24'),
(2, 'b4feac75-0918-421e-89e7-cc1d794dc243', 'database', 'default', '{\"uuid\":\"b4feac75-0918-421e-89e7-cc1d794dc243\",\"displayName\":\"App\\\\Jobs\\\\ImportJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\ImportJob\",\"command\":\"O:18:\\\"App\\\\Jobs\\\\ImportJob\\\":11:{s:7:\\\"\\u0000*\\u0000file\\\";s:15:\\\"1631511176.xlsx\\\";s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'ErrorException: Undefined property: App\\Jobs\\ImportJob::$file in D:\\DATA E\\web\\htdocs\\PaySlip\\app\\Jobs\\ImportJob.php:35\nStack trace:\n#0 D:\\DATA E\\web\\htdocs\\PaySlip\\app\\Jobs\\ImportJob.php(35): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(8, \'Undefined prope...\', \'D:\\\\DATA E\\\\web\\\\h...\', 35, Array)\n#1 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): App\\Jobs\\ImportJob->handle()\n#2 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#3 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#4 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#5 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(651): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#6 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(128): Illuminate\\Container\\Container->call(Array)\n#7 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\ImportJob))\n#8 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\ImportJob))\n#9 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#10 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(120): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\ImportJob), false)\n#11 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\ImportJob))\n#12 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\ImportJob))\n#13 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#14 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\ImportJob))\n#15 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#16 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(428): Illuminate\\Queue\\Jobs\\Job->fire()\n#17 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(378): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#18 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(172): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#19 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(117): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#20 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(101): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#21 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#22 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#23 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#24 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#25 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(651): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#26 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(136): Illuminate\\Container\\Container->call(Array)\n#27 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\symfony\\console\\Command\\Command.php(299): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#28 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#29 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\symfony\\console\\Application.php(978): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#30 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\symfony\\console\\Application.php(295): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#31 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\symfony\\console\\Application.php(167): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#32 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php(92): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#33 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#34 D:\\DATA E\\web\\htdocs\\PaySlip\\artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#35 {main}', '2021-09-12 22:32:58'),
(3, '79b11b5d-9610-4c01-a876-fbcd50ac9a46', 'database', 'default', '{\"uuid\":\"79b11b5d-9610-4c01-a876-fbcd50ac9a46\",\"displayName\":\"App\\\\Jobs\\\\ImportJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\ImportJob\",\"command\":\"O:18:\\\"App\\\\Jobs\\\\ImportJob\\\":11:{s:7:\\\"\\u0000*\\u0000file\\\";s:15:\\\"1631511676.xlsx\\\";s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'ErrorException: Undefined property: App\\Jobs\\ImportJob::$file in D:\\DATA E\\web\\htdocs\\PaySlip\\app\\Jobs\\ImportJob.php:35\nStack trace:\n#0 D:\\DATA E\\web\\htdocs\\PaySlip\\app\\Jobs\\ImportJob.php(35): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(8, \'Undefined prope...\', \'D:\\\\DATA E\\\\web\\\\h...\', 35, Array)\n#1 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): App\\Jobs\\ImportJob->handle()\n#2 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#3 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#4 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#5 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(651): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#6 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(128): Illuminate\\Container\\Container->call(Array)\n#7 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\ImportJob))\n#8 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\ImportJob))\n#9 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#10 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(120): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\ImportJob), false)\n#11 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\ImportJob))\n#12 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\ImportJob))\n#13 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#14 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\ImportJob))\n#15 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#16 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(428): Illuminate\\Queue\\Jobs\\Job->fire()\n#17 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(378): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#18 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(172): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#19 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(117): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#20 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(101): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#21 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#22 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#23 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#24 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#25 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(651): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#26 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(136): Illuminate\\Container\\Container->call(Array)\n#27 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\symfony\\console\\Command\\Command.php(299): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#28 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#29 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\symfony\\console\\Application.php(978): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#30 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\symfony\\console\\Application.php(295): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#31 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\symfony\\console\\Application.php(167): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#32 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php(92): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#33 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#34 D:\\DATA E\\web\\htdocs\\PaySlip\\artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#35 {main}', '2021-09-12 22:41:19'),
(4, 'bfdd6ad0-3788-4190-bc01-d19cc173ddcd', 'database', 'default', '{\"uuid\":\"bfdd6ad0-3788-4190-bc01-d19cc173ddcd\",\"displayName\":\"App\\\\Jobs\\\\ImportJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\ImportJob\",\"command\":\"O:18:\\\"App\\\\Jobs\\\\ImportJob\\\":11:{s:7:\\\"\\u0000*\\u0000file\\\";s:15:\\\"1631511732.xlsx\\\";s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'ErrorException: Undefined property: App\\Jobs\\ImportJob::$file in D:\\DATA E\\web\\htdocs\\PaySlip\\app\\Jobs\\ImportJob.php:35\nStack trace:\n#0 D:\\DATA E\\web\\htdocs\\PaySlip\\app\\Jobs\\ImportJob.php(35): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(8, \'Undefined prope...\', \'D:\\\\DATA E\\\\web\\\\h...\', 35, Array)\n#1 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): App\\Jobs\\ImportJob->handle()\n#2 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#3 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#4 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#5 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(651): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#6 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(128): Illuminate\\Container\\Container->call(Array)\n#7 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\ImportJob))\n#8 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\ImportJob))\n#9 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#10 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(120): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\ImportJob), false)\n#11 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\ImportJob))\n#12 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\ImportJob))\n#13 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#14 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\ImportJob))\n#15 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#16 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(428): Illuminate\\Queue\\Jobs\\Job->fire()\n#17 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(378): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#18 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(172): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#19 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(117): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#20 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(101): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#21 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#22 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#23 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#24 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#25 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(651): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#26 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(136): Illuminate\\Container\\Container->call(Array)\n#27 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\symfony\\console\\Command\\Command.php(299): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#28 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#29 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\symfony\\console\\Application.php(978): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#30 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\symfony\\console\\Application.php(295): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#31 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\symfony\\console\\Application.php(167): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#32 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php(92): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#33 D:\\DATA E\\web\\htdocs\\PaySlip\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#34 D:\\DATA E\\web\\htdocs\\PaySlip\\artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#35 {main}', '2021-09-12 22:42:13');

-- --------------------------------------------------------

--
-- Table structure for table `fail_upload_komponens`
--

CREATE TABLE `fail_upload_komponens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `baris` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_ktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `info_pengumumen`
--

CREATE TABLE `info_pengumumen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `info_pengumumen`
--

INSERT INTO `info_pengumumen` (`id`, `judul`, `description`, `image`, `caption`, `created_at`, `updated_at`) VALUES
(3, 'Selalu Utamakan Keselamatan', 'Gunakan Selalu APD Anda', '1642923880_61ed0768ecbb5.jpeg', NULL, '2022-01-23 00:44:41', '2022-01-23 00:44:41'),
(4, 'Alat Pelindung Diri', NULL, '1642923969_61ed07c1ab1fb.jpg', 'Selalu Gunakan APD anda', '2022-01-23 00:46:09', '2022-01-23 00:46:09');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `komponen_gajis`
--

CREATE TABLE `komponen_gajis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `data_karyawan_id` bigint(20) UNSIGNED NOT NULL,
  `durasi_sp` date DEFAULT NULL,
  `jml_hari_kerja` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jml_hour_machine` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gaji_pokok` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tunj_um` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tunj_pengawas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tunj_transport` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tunj_mk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tunj_koefisien` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ot` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rapel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insentif` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tunj_lap` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jht` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pot_bpjskes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unpaid_leave` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deduction` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tot_diterima` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `periode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `departemen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `divisi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `posisi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_gaji` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bonus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deduction_pph21` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `komponen_gajis`
--

INSERT INTO `komponen_gajis` (`id`, `data_karyawan_id`, `durasi_sp`, `jml_hari_kerja`, `jml_hour_machine`, `gaji_pokok`, `tunj_um`, `tunj_pengawas`, `tunj_transport`, `tunj_mk`, `tunj_koefisien`, `ot`, `hm`, `rapel`, `insentif`, `tunj_lap`, `jht`, `jp`, `pot_bpjskes`, `unpaid_leave`, `deduction`, `tot_diterima`, `bank_name`, `bank_number`, `periode`, `created_at`, `updated_at`, `departemen`, `divisi`, `posisi`, `status_gaji`, `thr`, `bonus`, `deduction_pph21`) VALUES
(216306, 165702, '1970-01-01', '18', '144', '2955014', '270000', '300000', '0', '250000', '250000', '0', '864000', '0', '0', '0', '59100.28', '29550.14', '29550.14', '98500.466666667', '0', '4672312.9733333', 'BNI', '0413893314', '2021-11', '2022-01-20 03:33:36', '2022-01-20 03:33:36', 'EQUIPMENT 设备部', 'BATCHING PLANT 搅拌站', 'BATCHING PLANT 搅拌站/PENGAWAS', 'FULL', '90000', '8000000', '50000'),
(216307, 165703, '1970-01-01', '20', '160', '3500000', '300000', '500000', '0', '250000', '250000', '0', '960000', '0', '0', '0', '70000', '35000', '35000', '0', '0', '5620000', 'BNI', '0393468708', '2021-11', '2022-01-20 03:33:36', '2022-01-20 03:33:36', 'EQUIPMENT 设备部', 'BATCHING PLANT 搅拌站', 'BATCHING PLANT 搅拌站大班长/KOORDINATOR', 'FULL', '0', '0', '50000'),
(216308, 165704, '1970-01-01', '22', '176', '2955014', '330000', '200000', '0', '200000', '250000', '0', '880000', '0', '0', '0', '59100.28', '29550.14', '29550.14', '0', '0', '4696813.44', 'BNI', '0502999908', '2021-11', '2022-01-20 03:33:36', '2022-01-20 03:33:36', 'EQUIPMENT 设备部', 'BATCHING PLANT 搅拌站', 'BATCHING PLANT 搅拌站普工 / WAKIL PENGAWAS', 'FULL', '5000000', '5000000', '50000');

-- --------------------------------------------------------

--
-- Table structure for table `lupa_passwords`
--

CREATE TABLE `lupa_passwords` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_09_12_133921_add_level_and_status', 2),
(6, '2021_09_13_033056_create_data_karyawans_table', 3),
(7, '2021_09_13_033532_create_komponen_gajis_table', 4),
(8, '2021_09_13_051036_create_jobs_table', 5),
(9, '2021_09_14_022520_add_token_id', 6),
(10, '2021_09_14_022915_add_token_id', 7),
(11, '2021_09_15_055405_create_lupa_passwords_table', 8),
(12, '2021_10_02_112223_nm_perusahaan', 9),
(13, '2021_10_05_072022_create_fail_upload_komponens_table', 10),
(14, '2022_01_20_061835_create_info_pengumumen_table', 10),
(15, '2022_01_20_062846_add__n_p_w_p__b_p_j_s', 11),
(16, '2022_01_20_081853_add__departemen_posisi_posisi', 12);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('iswan@mail.com', '$2y$10$82ebEQTjYlVCfaFNEaydsuCP.l3FGoEFcXD0LY.YRLxJKchxfpBEq', '2021-09-14 21:32:07'),
('ris@mail.com', '$2y$10$VrSofmO/fIXSLz.r.QT/k.9MsEqDpd8xllPCCC7cD.G3sewj3jxnm', '2021-09-14 21:39:44');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resend_emails`
--

CREATE TABLE `resend_emails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `waktu` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_karyawan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `level`, `status`, `data_karyawan_id`, `token`) VALUES
(1, 'Iswan', 'iswan@mail.com', NULL, '$2y$10$bHMJDCpUDGiCiKut0l/Lr.hcOwPnCJSifPTyTJfMm6bY5nT6McZ.m', NULL, NULL, '2022-01-23 23:34:10', 'Administrator', 'Aktif', NULL, ''),
(27, 'ardhif', 'jasawebjakarta@gmail.com', NULL, '$2y$10$Xnx.GH0rYuj2flG5inK2.Of23AMGRteX3cjjSzerV9aE06U.66aYq', NULL, '2021-09-16 23:36:21', '2021-10-04 12:28:11', 'Administrator', 'Aktif', NULL, ''),
(30, 'Abdul Haris Maulana', 'azheir4@gmail.com', NULL, '$2y$10$AU1mSFFOeCeFNSIpDsAqSeuWCkEpYeZgIKc2Nrv0j2kSGYY7UlTMK', NULL, '2021-10-04 07:44:17', '2021-10-04 07:46:58', 'Administrator', 'Aktif', NULL, ''),
(31, 'Reski Astuti', 'reskivdni14@gmail.com', NULL, '$2y$10$ELVvN8tzHXI3z1BUqaaxROIbK1U7vie9Q.9fpltNuhPSZkSlpHSAu', NULL, '2021-10-04 07:45:02', '2021-10-04 07:45:02', 'Administrator', 'Aktif', NULL, ''),
(32, 'Muh. Rizfi Pratama', 'mrisfi69@gmail.com', NULL, '$2y$10$GxZxeaT5poOxSmMRoM7isOjlwFv1041lVQNbjAQaVarm2SKc0Jqbu', NULL, '2021-10-04 07:45:49', '2021-10-04 07:45:49', 'Administrator', 'Aktif', NULL, ''),
(4602, 'DARSIAWAN', 'ishwan.hamdah@gmail.com', NULL, '$2y$10$7rw7Rj.NcpXikLvtc46yZeEvN79TCfEF.zyCSgZ064bVymiE0/Z6.', NULL, '2022-01-22 04:12:53', '2022-01-23 00:20:55', 'Pengguna', 'Aktif', 165702, 'agmiDvcUIxWWYOtlsXYR0dk0ckGKGEqiAimUEWcGaotJ4IiYXEWhfC3opkLJ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_karyawans`
--
ALTER TABLE `data_karyawans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_karyawans_nik_unique` (`nik`),
  ADD UNIQUE KEY `data_karyawans_no_ktp_unique` (`no_ktp`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fail_upload_komponens`
--
ALTER TABLE `fail_upload_komponens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info_pengumumen`
--
ALTER TABLE `info_pengumumen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `komponen_gajis`
--
ALTER TABLE `komponen_gajis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `komponen_gajis_data_karyawan_id_foreign` (`data_karyawan_id`);

--
-- Indexes for table `lupa_passwords`
--
ALTER TABLE `lupa_passwords`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lupa_passwords_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `resend_emails`
--
ALTER TABLE `resend_emails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resend_emails_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_data_karyawan_id_foreign` (`data_karyawan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_karyawans`
--
ALTER TABLE `data_karyawans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165706;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fail_upload_komponens`
--
ALTER TABLE `fail_upload_komponens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `info_pengumumen`
--
ALTER TABLE `info_pengumumen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `komponen_gajis`
--
ALTER TABLE `komponen_gajis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216309;

--
-- AUTO_INCREMENT for table `lupa_passwords`
--
ALTER TABLE `lupa_passwords`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=433;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resend_emails`
--
ALTER TABLE `resend_emails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=436;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4603;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komponen_gajis`
--
ALTER TABLE `komponen_gajis`
  ADD CONSTRAINT `komponen_gajis_data_karyawan_id_foreign` FOREIGN KEY (`data_karyawan_id`) REFERENCES `data_karyawans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lupa_passwords`
--
ALTER TABLE `lupa_passwords`
  ADD CONSTRAINT `lupa_passwords_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `resend_emails`
--
ALTER TABLE `resend_emails`
  ADD CONSTRAINT `resend_emails_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_data_karyawan_id_foreign` FOREIGN KEY (`data_karyawan_id`) REFERENCES `data_karyawans` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
