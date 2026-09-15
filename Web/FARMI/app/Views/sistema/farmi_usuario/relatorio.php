<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Ícone -->
    <link rel="icon" href="<?= base_url('assets/images/about.png') ?>">
	<title>Relatório de Monitoramento IoT - FARMI</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

	<style>
		* {
			box-sizing: border-box;
		}

		body {
			margin: 0;
			padding: 20px;
			background: #f1f5f2;
			color: #052501;
			font-family: Arial, Helvetica, sans-serif;
		}

		.pagina {
			max-width: 1200px;
			margin: auto;
		}

		.configuracao {
			background: #fff;
			border-radius: 12px;
			padding: 20px;
			margin-bottom: 20px;
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
		}

		.configuracao h2 {
			margin: 0 0 18px;
			color: #052501;
		}

		.filtros {
			display: grid;
			grid-template-columns: repeat(4, 1fr);
			gap: 15px;
			align-items: end;
		}

		.campo {
			display: flex;
			flex-direction: column;
			gap: 6px;
		}

		.campo label {
			font-size: 14px;
			font-weight: bold;
		}

		.campo input,
		.campo select {
			height: 40px;
			padding: 0 10px;
			border: 1px solid #ccd5ce;
			border-radius: 7px;
			background: #fff;
		}

		.botoes {
			display: flex;
			gap: 10px;
			margin-top: 15px;
		}

		.btn {
			height: 40px;
			border: none;
			border-radius: 7px;
			padding: 0 18px;
			cursor: pointer;
			font-weight: bold;
			text-decoration: none;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			gap: 7px;
		}

		.btn-gerar {
			background: #4bc714;
			color: #fff;
		}

		.btn-imprimir {
			background: #052501;
			color: #fff;
		}

		.btn-voltar {
			background: #e5e7eb;
			color: #111827;
		}

		.relatorio {
			background: #fff;
			padding: 35px;
			box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
		}

		.cabecalho {
			border-bottom: 3px solid #4bc714;
			padding-bottom: 18px;
			margin-bottom: 20px;
		}

		.cabecalho-topo {
			display: flex;
			justify-content: space-between;
			align-items: flex-start;
			gap: 20px;
		}

		.logo-texto {
			font-size: 32px;
			font-weight: 800;
			color: #052501;
			margin: 0;
		}

		.subtitulo {
			margin: 4px 0 0;
			color: #4b5563;
			font-size: 14px;
		}

		.data-geracao {
			text-align: right;
			font-size: 13px;
			color: #4b5563;
		}

		.info-geral {
			display: grid;
			grid-template-columns: repeat(4, 1fr);
			gap: 12px;
			margin: 20px 0;
		}

		.info-box {
			border: 1px solid #dfe6e1;
			border-radius: 8px;
			padding: 12px;
		}

		.info-box span {
			display: block;
			font-size: 12px;
			color: #6b7280;
			margin-bottom: 4px;
		}

		.info-box strong {
			font-size: 15px;
		}

		.secao {
			margin-top: 30px;
		}

		.secao h2 {
			font-size: 20px;
			margin: 0 0 12px;
			color: #052501;
		}

		.tabela-container {
			width: 100%;
			overflow-x: auto;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			font-size: 12px;
		}

		th {
			background: #052501;
			color: #fff;
			padding: 9px;
			text-align: left;
		}

		td {
			border-bottom: 1px solid #e5e7eb;
			padding: 8px;
		}

		tr:nth-child(even) td {
			background: #f8faf9;
		}

		.status-ativo {
			color: #15803d;
			font-weight: bold;
		}

		.status-inativo {
			color: #b91c1c;
			font-weight: bold;
		}

		.grupo {
			margin-bottom: 35px;
			page-break-inside: avoid;
		}

		.titulo-grupo {
			background: #eaf5e8;
			border-left: 5px solid #4bc714;
			padding: 12px 15px;
			margin-bottom: 12px;
		}

		.titulo-grupo strong {
			font-size: 18px;
		}

		.titulo-grupo small {
			display: block;
			margin-top: 4px;
			color: #4b5563;
		}

		.resumo {
			display: grid;
			grid-template-columns: repeat(4, 1fr);
			gap: 10px;
			margin-top: 12px;
		}

		.resumo-box {
			border: 1px solid #dfe6e1;
			border-radius: 7px;
			padding: 10px;
		}

		.resumo-box span {
			display: block;
			font-size: 11px;
			color: #6b7280;
		}

		.resumo-box strong {
			display: block;
			margin-top: 4px;
			font-size: 14px;
		}

		.sem-dados {
			text-align: center;
			padding: 30px;
			color: #6b7280;
			border: 1px dashed #cbd5cf;
			border-radius: 8px;
		}

		.rodape {
			border-top: 2px solid #dfe6e1;
			margin-top: 35px;
			padding-top: 12px;
			text-align: center;
			color: #6b7280;
			font-size: 12px;
		}

		@media (max-width: 900px) {
			.filtros,
			.info-geral,
			.resumo {
				grid-template-columns: repeat(2, 1fr);
			}
		}

		@media (max-width: 600px) {
			body {
				padding: 10px;
			}

			.relatorio {
				padding: 20px;
			}

			.filtros,
			.info-geral,
			.resumo {
				grid-template-columns: 1fr;
			}

			.cabecalho-topo {
				flex-direction: column;
			}

			.data-geracao {
				text-align: left;
			}
		}

		@media print {
			@page {
				size: A4;
				margin: 12mm;
			}

			body {
				background: #fff;
				padding: 0;
			}

			.configuracao {
				display: none;
			}

			.relatorio {
				box-shadow: none;
				padding: 0;
			}

			.pagina {
				max-width: none;
			}

			.grupo {
				page-break-inside: auto;
			}

			table {
				page-break-inside: auto;
			}

			tr {
				page-break-inside: avoid;
			}

			th,
			.titulo-grupo {
				-webkit-print-color-adjust: exact;
				print-color-adjust: exact;
			}
		}
	</style>
</head>

<body>
	<div class="pagina">
		<div class="configuracao">
			<h2>
				<i class="fa-solid fa-file-lines"></i>
				Configurar Relatório
			</h2>

			<form method="GET" action="<?= base_url('/relatorio') ?>">
				<div class="filtros">
					<div class="campo">
						<label for="data_inicio">Data inicial</label>
						<input type="date" id="data_inicio" name="data_inicio" value="<?= esc($dataInicio) ?>" required>
					</div>

					<div class="campo">
						<label for="data_fim">Data final</label>
						<input type="date" id="data_fim" name="data_fim" value="<?= esc($dataFim) ?>" required>
					</div>

					<div class="campo">
						<label for="fazenda">Fazenda</label>
						<select id="fazenda" name="fazenda">
							<option value="">Todas as fazendas</option>
							<?php foreach ($fazendas as $fazenda): ?>
								<option value="<?= $fazenda['ID_FAZENDA'] ?>" <?= ($idFazenda == $fazenda['ID_FAZENDA']) ? 'selected' : '' ?>>
									<?= esc($fazenda['NOME']) ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="campo">
						<label for="cultura">Cultura</label>
						<select id="cultura" name="cultura">
							<option value="">Todas as culturas</option>
							<?php foreach ($culturas as $cultura): ?>
								<option value="<?= $cultura['ID_CULTURA'] ?>" data-fazenda="<?= $cultura['FK_ID_FAZENDA'] ?>" <?= ($idCultura == $cultura['ID_CULTURA']) ? 'selected' : '' ?>>
									<?= esc($cultura['NOME_CULTURA']) ?> - <?= esc($cultura['NOME_FAZENDA']) ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

				<div class="botoes">
					<button type="submit" class="btn btn-gerar">
						<i class="fa-solid fa-magnifying-glass"></i>
						Gerar Relatório
					</button>

					<button type="button" class="btn btn-imprimir" onclick="window.print()">
						<i class="fa-solid fa-print"></i>
						Imprimir
					</button>

					<a href="<?= base_url('/dashboard-admin') ?>" class="btn btn-voltar">
						<i class="fa-solid fa-arrow-left"></i>
						Voltar
					</a>
				</div>
			</form>
		</div>

		<div class="relatorio">
			<div class="cabecalho">
				<div class="cabecalho-topo">
					<div>
						<h1 class="logo-texto">FARMI</h1>
						<p class="subtitulo">Relatório de Monitoramento IoT</p>
						<p class="subtitulo">Tecnologia que protege e faz sua fazenda crescer</p>
					</div>

					<div class="data-geracao">
						<strong>Data de geração</strong><br>
						<?= date('d/m/Y H:i') ?>
					</div>
				</div>
			</div>

			<div class="info-geral">
				<div class="info-box">
					<span>Período inicial</span>
					<strong><?= date('d/m/Y', strtotime($dataInicio)) ?></strong>
				</div>

				<div class="info-box">
					<span>Período final</span>
					<strong><?= date('d/m/Y', strtotime($dataFim)) ?></strong>
				</div>

				<div class="info-box">
					<span>Fazendas</span>
					<strong><?= empty($idFazenda) ? 'Todas' : 'Selecionada' ?></strong>
				</div>

				<div class="info-box">
					<span>Sensores encontrados</span>
					<strong><?= count($sensores) ?></strong>
				</div>
			</div>

			<section class="secao">
				<h2>
					<i class="fa-solid fa-microchip"></i>
					Sensores utilizados
				</h2>

				<?php if (!empty($sensores)): ?>
					<div class="tabela-container">
						<table>
							<thead>
								<tr>
									<th>ID</th>
									<th>Sensor</th>
									<th>Tipo</th>
									<th>Unidade</th>
									<th>Cultura</th>
									<th>Fazenda</th>
									<th>Última leitura</th>
									<th>Valor</th>
									<th>Status</th>
								</tr>
							</thead>

							<tbody>
								<?php foreach ($sensores as $sensor): ?>
									<tr>
										<td><?= $sensor['ID_SENSOR'] ?></td>
										<td><?= esc($sensor['NOME_SENSOR']) ?></td>
										<td><?= esc($sensor['TIPO_SENSOR']) ?></td>
										<td><?= esc($sensor['UNIDADE_MEDIDA']) ?></td>
										<td><?= esc($sensor['NOME_CULTURA']) ?></td>
										<td><?= esc($sensor['NOME_FAZENDA']) ?></td>
										<td>
											<?php if (!empty($sensor['ULTIMA_DATA'])): ?>
												<?= date('d/m/Y H:i:s', strtotime($sensor['ULTIMA_DATA'])) ?>
											<?php else: ?>
												Sem leitura
											<?php endif; ?>
										</td>
										<td>
											<?php if ($sensor['ULTIMO_VALOR'] !== null): ?>
												<?= esc($sensor['ULTIMO_VALOR']) ?>
												<?= esc($sensor['UNIDADE_MEDIDA']) ?>
											<?php else: ?>
												—
											<?php endif; ?>
										</td>
										<td>
											<?php if (
												strtolower($sensor['STATUS']) === 'ativo' ||
												strtolower($sensor['STATUS']) === 'ativa'
											): ?>
												<span class="status-ativo">Ativo</span>
											<?php else: ?>
												<span class="status-inativo">
													<?= esc($sensor['STATUS']) ?>
												</span>
											<?php endif; ?>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				<?php else: ?>
					<div class="sem-dados">
						Nenhum sensor encontrado para os filtros selecionados.
					</div>
				<?php endif; ?>
			</section>

			<section class="secao">
				<h2>
					<i class="fa-solid fa-chart-line"></i>
					Histórico das medições IoT
				</h2>

				<?php if (!empty($grupos)): ?>
					<?php foreach ($grupos as $grupo): ?>
						<div class="grupo">
							<div class="titulo-grupo">
								<strong>
									<?= esc($grupo['NOME_FAZENDA']) ?> —
									<?= esc($grupo['NOME_CULTURA']) ?>
								</strong>

								<small>
									Cultura ID: <?= $grupo['ID_CULTURA'] ?> |
									Sensores: <?= count($grupo['sensores']) ?>
								</small>
							</div>

							<?php if (!empty($grupo['leituras'])): ?>
								<div class="tabela-container">
									<table>
										<thead>
											<tr>
												<th>Data</th>
												<th>Horário</th>

												<?php foreach ($grupo['sensores'] as $sensor): ?>
													<th>
														<?= esc($sensor['NOME_SENSOR']) ?>

														<?php if (!empty($sensor['UNIDADE_MEDIDA'])): ?>
															(<?= esc($sensor['UNIDADE_MEDIDA']) ?>)
														<?php endif; ?>
													</th>
												<?php endforeach; ?>
											</tr>
										</thead>

										<tbody>
											<?php foreach ($grupo['leituras'] as $momento => $valores): ?>
												<tr>
													<td>
														<?= date('d/m/Y', strtotime($momento)) ?>
													</td>

													<td>
														<?= date('H:i', strtotime($momento)) ?>
													</td>

													<?php foreach ($grupo['sensores'] as $idSensor => $sensor): ?>
														<td>
															<?php if (isset($valores[$idSensor])): ?>
																<?= esc($valores[$idSensor]['valor']) ?>
															<?php else: ?>
																—
															<?php endif; ?>
														</td>
													<?php endforeach; ?>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							<?php else: ?>
								<div class="sem-dados">
									Nenhuma medição encontrada no período selecionado.
								</div>
							<?php endif; ?>

							<?php if (!empty($grupo['medias'])): ?>
								<div class="resumo">
									<?php foreach ($grupo['medias'] as $idSensor => $media): ?>
										<?php $sensorResumo = $grupo['sensores'][$idSensor] ?? null; ?>

										<?php if ($sensorResumo): ?>
											<div class="resumo-box">
												<span>
													Média — <?= esc($sensorResumo['NOME_SENSOR']) ?>
												</span>

												<strong>
													<?= number_format($media, 2, ',', '.') ?>
													<?= esc($sensorResumo['UNIDADE_MEDIDA']) ?>
												</strong>
											</div>
										<?php endif; ?>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<div class="sem-dados">
						<i class="fa-solid fa-database"></i>
						<br><br>
						Nenhum dado encontrado para o período e filtros selecionados.
					</div>
				<?php endif; ?>
			</section>

			<div class="rodape">
				FARMI — Fazenda Automatizada Remota de Monitoramento Inteligente<br>
				Tecnologia que protege e faz sua fazenda crescer<br>
				Relatório gerado automaticamente pelo sistema.
			</div>
		</div>
	</div>

	<script>
		const selectFazenda = document.getElementById('fazenda');
		const selectCultura = document.getElementById('cultura');

		function filtrarCulturas() {
			const fazendaSelecionada = selectFazenda.value;

			Array.from(selectCultura.options).forEach(option => {
				if (option.value === '') {
					option.hidden = false;
					return;
				}

				const fazenda = option.dataset.fazenda;

				option.hidden =
					fazendaSelecionada !== '' &&
					fazenda !== fazendaSelecionada;
			});

			const culturaSelecionada =
				selectCultura.options[selectCultura.selectedIndex];

			if (culturaSelecionada && culturaSelecionada.hidden) {
				selectCultura.value = '';
			}
		}

		selectFazenda.addEventListener('change', filtrarCulturas);
		filtrarCulturas();
	</script>
</body>
</html>