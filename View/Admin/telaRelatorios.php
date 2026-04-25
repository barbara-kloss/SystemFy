<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatorios</title>
    <link rel="stylesheet" href="/css/telaRelatorios.css">
    <link rel="stylesheet" href="/css/notifications.css">
    <link href="https://fonts.googleapis.com/css2?family=Alata&family=Akshar:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="/js/notifications.js"></script>
</head>
<body>
    <div class="background">
        <div class="bolinha bolinha1"></div>
        <div class="bolinha bolinha2"></div>
        <div class="bolinha bolinha3"></div>
        <div class="bolinha bolinha4"></div>
        <div class="bolinha bolinha5"></div>
        <div class="bolinha bolinha6"></div>

        <div class="logoCantoInferior">
            <img src="/imgFy/logoSemfundoEscritaBranca.png" alt="Logo">
        </div>

        <a href="https://wa.me/5541991720658" class="logoWhatsApp" target="_blank" rel="noopener noreferrer">
            <img src="/imgFy/whatsapp (3).png" alt="logoWhatsApp">
        </a>

        <div class="fundoSemiTransparente">
            <div class="main-content-grid">
                <div class="navBar">
                    <nav>
                        <ul class="navbar-nav">
                            <li class="nav-item"><a href="/admin">Home</a></li>
                            <li class="nav-item"><a href="/admin/menu/list">Nutricional</a></li>
                            <li class="nav-item"><a href="/admin/exercise/list">Treinos</a></li>
                            <li class="nav-item"><a href="/cadastro">Clientes</a></li>
                            <li class="nav-item"><a href="/admin/report/list" class="active">Relatorios</a></li>
                            <li class="nav-item"><a href="/admin/plano/list">Planos</a></li>
                        </ul>
                    </nav>
                </div>

                <div class="profile-box-container">
                    <a href="/admin/perfil" class="profile-link">
                        <div class="cardVerPerfil"><i class="fas fa-user"></i></div>
                        <div class="textocardVerPerfil">Ver perfil</div>
                    </a>
                </div>

                <div class="content-cards-wrapper">
                    <h2 class="section-title">Escolha o tipo de relatorio</h2>

                    <div class="report-filters">
                        <div class="filter-field">
                            <label for="searchTerm">Pesquisar</label>
                            <input type="text" id="searchTerm" placeholder="Nome, plano, descricao...">
                        </div>

                        <div class="filter-field">
                            <label for="statusFilter">Status</label>
                            <select id="statusFilter">
                                <option value="">Todos</option>
                                <option value="Ativo">Ativo</option>
                                <option value="Inativo">Inativo</option>
                                <option value="Agendado">Agendado</option>
                            </select>
                        </div>

                        <div class="filter-field">
                            <label for="dateFrom">Data inicial</label>
                            <input type="date" id="dateFrom">
                        </div>

                        <div class="filter-field">
                            <label for="dateTo">Data final</label>
                            <input type="date" id="dateTo">
                        </div>

                        <button type="button" class="btn-clear-filters" id="clearFilters">Limpar filtros</button>
                    </div>

                    <div class="relatorio-card">
                        <i class="fas fa-users card-icon"></i>
                        <h3 class="card-title">Clientes</h3>
                        <h4 class="card-description">Relatorio de clientes ativos</h4>
                        <p class="card-help">Usa os filtros acima para pesquisar antes de exportar.</p>
                        <div class="export-options">
                            <button class="btn-export" data-export="pdf"><i class="fas fa-file-pdf"></i> PDF</button>
                            <button class="btn-export" data-export="csv"><i class="fas fa-file-csv"></i> CSV</button>
                        </div>
                    </div>

                    <div class="relatorio-card">
                        <i class="fas fa-dollar-sign card-icon"></i>
                        <h3 class="card-title">Faturamento</h3>
                        <h4 class="card-description">Relatorio de faturamento</h4>
                        <p class="card-help">Pesquisa por descricao, tipo ou valor do resumo.</p>
                        <div class="export-options">
                            <button class="btn-export" data-export="pdf"><i class="fas fa-file-pdf"></i> PDF</button>
                            <button class="btn-export" data-export="csv"><i class="fas fa-file-csv"></i> CSV</button>
                        </div>
                    </div>

                    <div class="relatorio-card">
                        <i class="fas fa-calendar-alt card-icon"></i>
                        <h3 class="card-title">Agenda</h3>
                        <h4 class="card-description">Relatorio de agenda</h4>
                        <p class="card-help">Permite filtrar por texto e periodo das reunioes.</p>
                        <div class="export-options">
                            <button class="btn-export" data-export="pdf"><i class="fas fa-file-pdf"></i> PDF</button>
                            <button class="btn-export" data-export="csv"><i class="fas fa-file-csv"></i> CSV</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const exportButtons = document.querySelectorAll('.btn-export');
            const clearFiltersButton = document.getElementById('clearFilters');
            const searchTermInput = document.getElementById('searchTerm');
            const statusFilterInput = document.getElementById('statusFilter');
            const dateFromInput = document.getElementById('dateFrom');
            const dateToInput = document.getElementById('dateTo');
            const jsPDF = window.jspdf ? window.jspdf.jsPDF : null;

            function showMessage(message, type, duration) {
                if (typeof window.showToast === 'function') {
                    window.showToast(message, type, duration);
                    return;
                }

                console[type === 'error' ? 'error' : 'log'](message);
            }

            function getFiltros() {
                return {
                    termo: (searchTermInput.value || '').trim().toLowerCase(),
                    status: statusFilterInput.value || '',
                    dataInicial: dateFromInput.value || '',
                    dataFinal: dateToInput.value || ''
                };
            }

            function simulateTextDownload(filename, text, mimeType) {
                const element = document.createElement('a');
                element.setAttribute('href', `data:${mimeType};charset=utf-8,${encodeURIComponent(text)}`);
                element.setAttribute('download', filename);
                element.style.display = 'none';
                document.body.appendChild(element);
                element.click();
                document.body.removeChild(element);
            }

            async function buscarDadosRelatorio(type) {
                try {
                    const urls = {
                        Clientes: '/admin/report/clientes',
                        Faturamento: '/admin/report/faturamento',
                        Agenda: '/admin/report/agenda'
                    };

                    const url = urls[type];
                    if (!url) {
                        throw new Error('Tipo de relatorio invalido');
                    }

                    const response = await fetch(url);
                    if (!response.ok) {
                        throw new Error(`Erro HTTP: ${response.status}`);
                    }

                    const result = await response.json();
                    if (!result.success) {
                        throw new Error(result.error || 'Erro ao buscar dados');
                    }

                    return result.data || [];
                } catch (error) {
                    console.error('Erro ao buscar dados do relatorio:', error);
                    showMessage('Erro ao buscar dados do relatorio: ' + error.message, 'error', 5000);
                    return null;
                }
            }

            function filtrarDadosRelatorio(type, dados, filtros) {
                return (dados || []).filter(item => {
                    const textoBase = Object.values(item)
                        .filter(value => value !== null && value !== undefined && typeof value !== 'object')
                        .join(' ')
                        .toLowerCase();

                    if (filtros.termo && !textoBase.includes(filtros.termo)) {
                        return false;
                    }

                    if (filtros.status && item.status && item.status !== filtros.status) {
                        return false;
                    }

                    if (type === 'Agenda' && (filtros.dataInicial || filtros.dataFinal)) {
                        const dataItem = item.data_raw || '';
                        if (!dataItem) {
                            return false;
                        }

                        if (filtros.dataInicial && dataItem < filtros.dataInicial) {
                            return false;
                        }

                        if (filtros.dataFinal && dataItem > filtros.dataFinal) {
                            return false;
                        }
                    }

                    return true;
                });
            }

            async function salvarRelatorio(tipo, dados, formato) {
                try {
                    const response = await fetch('/admin/report/save', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            tipo: tipo,
                            dados: dados,
                            formato: formato
                        })
                    });

                    const result = await response.json();
                    if (!result.success) {
                        console.error('Erro ao salvar relatorio:', result.error);
                    }
                } catch (error) {
                    console.error('Erro ao salvar relatorio:', error);
                }
            }

            function prepararTabela(type, dados) {
                const head = type === 'Faturamento'
                    ? [['Tipo', 'Descricao', 'Status', 'Valor']]
                    : [['ID', 'Nome/Compromisso', 'Status', 'Valor/Data']];

                let body = [];

                if (type === 'Clientes' || type === 'Agenda') {
                    body = dados.map(item => [
                        item.id ? String(item.id) : '',
                        item.nome || '',
                        item.status || '',
                        item.valor || ''
                    ]);
                }

                if (type === 'Faturamento') {
                    body = dados.map(item => [
                        item.tipo || '',
                        item.descricao || '',
                        item.status || '',
                        item.valor || ''
                    ]);
                }

                return { head, body };
            }

            function gerarCsv(fileName, head, body, type) {
                let csvContent = head[0].join(',') + '\n';
                body.forEach(row => {
                    csvContent += row
                        .map(cell => {
                            const value = Array.isArray(cell) ? cell.join(' | ') : cell;
                            return `"${String(value).replace(/"/g, '""')}"`;
                        })
                        .join(',') + '\n';
                });

                showMessage(`Preparando exportacao de ${type} como CSV...`, 'info', 2000);
                simulateTextDownload(fileName + '.csv', csvContent, 'text/csv');
            }

            function gerarPdf(fileName, head, body, type, description) {
                if (!jsPDF) {
                    showMessage('A biblioteca jsPDF nao carregou corretamente.', 'error', 5000);
                    return;
                }

                const doc = new jsPDF();
                const now = new Date().toLocaleDateString('pt-BR');

                doc.setFont('helvetica', 'bold');
                doc.setFontSize(18);
                doc.setTextColor(42, 42, 42);
                doc.text(`Relatorio de ${type}`, 105, 20, null, null, 'center');

                doc.setFontSize(10);
                doc.setFont('helvetica', 'normal');
                doc.setTextColor(102, 102, 102);
                doc.text(`Descricao: ${description}`, 20, 30, { maxWidth: 170 });
                doc.text(`Gerado em: ${now}`, 190, 10, null, null, 'right');

                let y = 45;
                doc.setFontSize(12);
                doc.text('Dados do relatorio:', 20, y);
                y += 8;

                const colPositions = type === 'Faturamento' ? [20, 55, 140, 175] : [20, 40, 110, 155];
                head[0].forEach((header, index) => {
                    doc.text(header, colPositions[index] || (20 + index * 40), y);
                });
                y += 5;
                doc.setLineWidth(0.5);
                doc.line(20, y, 190, y);
                y += 5;

                body.forEach(row => {
                    row.forEach((cell, index) => {
                        const value = Array.isArray(cell) ? cell.join(' | ') : String(cell || '');
                        doc.text(value.substring(0, 45), colPositions[index] || (20 + index * 40), y, {
                            maxWidth: index === 1 ? 75 : 30
                        });
                    });
                    y += 8;

                    if (y > 275) {
                        doc.addPage();
                        y = 20;
                    }
                });

                showMessage(`Gerando PDF para ${type}...`, 'info', 2000);
                doc.save(fileName + '.pdf');
            }

            clearFiltersButton.addEventListener('click', function () {
                searchTermInput.value = '';
                statusFilterInput.value = '';
                dateFromInput.value = '';
                dateToInput.value = '';
            });

            exportButtons.forEach(button => {
                button.addEventListener('click', async function () {
                    const format = this.getAttribute('data-export');
                    const card = this.closest('.relatorio-card');
                    const type = card.querySelector('.card-title').textContent.trim();
                    const fileName = `Relatorio_${type.replace(/\s/g, '')}_${new Date().toISOString().slice(0, 10)}`;

                    const dadosOriginais = await buscarDadosRelatorio(type);
                    if (!dadosOriginais) {
                        return;
                    }

                    const filtros = getFiltros();
                    const dados = filtrarDadosRelatorio(type, dadosOriginais, filtros);

                    if (!dados.length) {
                        showMessage('Nenhum dado encontrado com os filtros informados.', 'error', 4000);
                        return;
                    }

                    const description = `Dados filtrados do relatorio de ${type}.`;
                    const tabela = prepararTabela(type, dados);

                    await salvarRelatorio(type, dados, format);

                    if (format === 'csv') {
                        gerarCsv(fileName, tabela.head, tabela.body, type);
                        return;
                    }

                    gerarPdf(fileName, tabela.head, tabela.body, type, description);
                });
            });
        });
    </script>
</body>
</html>
