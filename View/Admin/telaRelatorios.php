<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios</title>
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

        

        <div class="fundoSemiTransparente">

            <div class="main-content-grid">

                <div class="navBar">
                    <nav>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="/admin">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/menu/list">Nutricional</a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/exercise/list">Treinos</a>
                            </li>
                            <li class="nav-item">
                                <a href="/cadastro">Clientes</a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/report/list" class="active">Relatorios</a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/plano/list">Planos</a>
                        </ul>
                    </nav>
                </div>

                <div class="profile-box-container">
                    <a href="/admin/cadastro" class="profile-link">
                        <div class="cardVerPerfil"> <i class="fas fa-user"></i> </div>
                        <div class="textocardVerPerfil"> Ver perfil </div>
                    </a>
                </div>

                <div class="content-cards-wrapper">

    <h2 class="section-title">Escolha o Tipo de Relatório</h2>

    <div class="relatorio-card">
        <i class="fas fa-users card-icon"></i>
        <h4 class="card-title">Clientes</h4>
        <h4 class="card-description">Relatorio de Clientes Ativos</h4>
        
        <div class="export-options">
            <button class="btn-export" data-export="pdf"><i class="fas fa-file-pdf"></i> PDF</button>
            <button class="btn-export" data-export="csv"><i class="fas fa-file-csv"></i> CSV</button>
        </div>
    </div>

    <div class="relatorio-card">
        <i class="fas fa-dollar-sign card-icon"></i>
        <h3 class="card-title">Faturamento</h3>
        <h4 class="card-description">Relatorio de Faturamento</h4>

        
        <div class="export-options">
            <button class="btn-export" data-export="pdf"><i class="fas fa-file-pdf"></i> PDF</button>
            <button class="btn-export" data-export="csv"><i class="fas fa-file-csv"></i> CSV</button>
        </div>
    </div>

    <div class="relatorio-card">
        <i class="fas fa-calendar-alt card-icon"></i>
        <h3 class="card-title">Agenda</h3>
        <h4 class="card-description">Relatorio de Agenda</h4>

        
        <div class="export-options">
            <button class="btn-export" data-export="pdf"><i class="fas fa-file-pdf"></i> PDF</button>
            <button class="btn-export" data-export="csv"><i class="fas fa-file-csv"></i> CSV</button>
        </div>
    </div>

</div>
        </div>
    </div>

 <script>
    document.addEventListener('DOMContentLoaded', function() {
        const exportButtons = document.querySelectorAll('.btn-export');
        const { jsPDF } = window.jspdf; 

        // Função para simular o download de um arquivo (usada para CSV)
        function simulateTextDownload(filename, text, mimeType) {
            const element = document.createElement('a');
            element.setAttribute('href', `data:${mimeType};charset=utf-8,${encodeURIComponent(text)}`);
            element.setAttribute('download', filename);
            
            element.style.display = 'none';
            document.body.appendChild(element);

            element.click(); 

            document.body.removeChild(element); 
        }

        // Função para buscar dados do servidor
        async function buscarDadosRelatorio(type) {
            try {
                let url = '';
                if (type === 'Clientes') {
                    url = '/admin/report/clientes';
                } else if (type === 'Faturamento') {
                    url = '/admin/report/faturamento';
                } else {
                    return null;
                }

                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error(`Erro HTTP: ${response.status}`);
                }
                
                const result = await response.json();
                if (result.success) {
                    return result.data;
                } else {
                    throw new Error(result.error || 'Erro ao buscar dados');
                }
                } catch (error) {
                    console.error('Erro ao buscar dados:', error);
                    showToast('Erro ao buscar dados do relatório: ' + error.message, 'error', 5000);
                    return null;
                }
        }

        // Função para salvar relatório no banco
        async function salvarRelatorio(tipo, dados, formato) {
            try {
                const response = await fetch('/admin/report/save', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        tipo: tipo,
                        dados: dados,
                        formato: formato
                    })
                });

                const result = await response.json();
                if (result.success) {
                    console.log('Relatório salvo com sucesso:', result.id);
                } else {
                    console.error('Erro ao salvar relatório:', result.error);
                }
            } catch (error) {
                console.error('Erro ao salvar relatório:', error);
            }
        }

        // 1. Lógica dos Botões de Exportação (PDF/CSV)
        exportButtons.forEach(button => {
            button.addEventListener('click', async function() {
                const format = this.getAttribute('data-export');
                const card = this.closest('.relatorio-card');
                const type = card.querySelector('.card-title').textContent.trim();
                
                const description = `Dados detalhados do relatório de ${type}.`; 
                const now = new Date().toLocaleDateString('pt-BR'); 
                let fileName = `Relatorio_${type.replace(/\s/g, '')}_${new Date().toISOString().slice(0, 10)}`;
                
                // Buscar dados do servidor
                let dados = await buscarDadosRelatorio(type);
                
                // Se não conseguir buscar dados, usar dados padrão (apenas para Agenda)
                if (!dados && type === 'Agenda') {
                    dados = [
                        { id: "4", nome: "Treino c/ João", status: "Confirmado", valor: "25/Dez 10:00" },
                        { id: "5", nome: "Consulta Nutri", status: "Pendente", valor: "26/Dez 14:00" }
                    ];
                } else if (!dados) {
                    showToast('Não foi possível carregar os dados do relatório.', 'error', 4000);
                    return;
                }

                // Preparar dados para exportação
                // Para Faturamento, usar cabeçalhos mais curtos para dar mais espaço
                const head = type === "Faturamento" 
                    ? [["Tipo", "Descrição", "Status", "Valor"]] 
                    : [["ID", "Nome/Compromisso", "Status", "Valor/Data"]];
                let body = [];

                if (type === "Clientes") {
                    body = dados.map(item => [
                        item.id?.toString() || '',
                        item.nome || '',
                        item.status || '',
                        item.valor || ''
                    ]);
                } else if (type === "Faturamento") {
                    body = dados.map(item => {
                        // Se for header ou separador, formatar diferente
                        if (item.isHeader) {
                            return [
                                item.tipo || '',
                                item.descricao || '',
                                '',
                                ''
                            ];
                        } else if (item.isSeparator) {
                            return ['', '', '', ''];
                        } else {
                            // Para descrição, processar quebras de linha
                            let descricao = (item.descricao || '---');
                            // Se tiver \n, converter para array de linhas (formato que autoTable entende melhor)
                            let descricaoLinhas;
                            if (descricao.includes('\\n')) {
                                descricaoLinhas = descricao.split('\\n');
                            } else {
                                descricaoLinhas = descricao;
                            }
                            
                            return [
                                item.tipo || '',
                                descricaoLinhas,
                                item.status || '---',
                                item.valor || ''
                            ];
                        }
                    });
                } else if (type === "Agenda") {
                    body = dados.map(item => [
                        item.id?.toString() || '',
                        item.nome || '',
                        item.status || '',
                        item.valor || ''
                    ]);
                }

                // Salvar relatório no banco
                await salvarRelatorio(type, dados, format);

                if (format === 'csv') {
                    // Gerar CSV
                    let csvContent = head[0].join(',') + '\n';
                    body.forEach(row => {
                        csvContent += row.map(cell => `"${cell}"`).join(',') + '\n';
                    });

                    showToast(`Preparando exportação de ${type} como CSV...`, 'info', 2000);
                    simulateTextDownload(fileName + '.csv', csvContent, 'text/csv');

                } else if (format === 'pdf') {
                    
                    if (typeof jsPDF !== 'undefined') {
                        showToast(`Gerando PDF para ${type}...`, 'info', 2000);
                        
                        const doc = new jsPDF();
                        // Para faturamento, usar orientação landscape se necessário ou ajustar margens
                        const title = `Relatório de ${type}`;
                        
                        // Configuração do PDF (Estilo Básico)
                        doc.setFont('helvetica', 'bold');
                        doc.setFontSize(18);
                        doc.setTextColor(42, 42, 42); 
                        doc.text(title, 105, 20, null, null, "center");
                        
                        doc.setFontSize(10);
                        doc.setFont('helvetica', 'normal');
                        doc.setTextColor(102, 102, 102);
                        doc.text(`Descrição: ${description}`, 20, 30, { maxWidth: 170 });
                        doc.text(`Gerado em: ${now}`, 190, 10, null, null, "right");
                        
                        // Geração da Tabela
                        if (typeof doc.autoTable === 'function') {
                            // Configuração especial para Faturamento
                            const isFaturamento = type === "Faturamento";
                            
                            doc.autoTable({
                                head: head,
                                body: body,
                                startY: 40,
                                theme: isFaturamento ? 'plain' : 'striped',
                                headStyles: { fillColor: [42, 42, 42], textColor: 255 },
                                styles: { 
                                    cellPadding: isFaturamento ? { top: 12, bottom: 12, left: 8, right: 8 } : 6, 
                                    fontSize: isFaturamento ? 9 : 10,
                                    lineWidth: 0.1,
                                    lineColor: [200, 200, 200],
                                    overflow: 'linebreak',
                                    cellMinHeight: isFaturamento ? 30 : 10
                                },
                                columnStyles: { 
                                    0: { cellWidth: isFaturamento ? 70 : 30, cellMinHeight: isFaturamento ? 30 : 10, overflow: 'linebreak' },  // ID/Tipo - aumentado para evitar sobreposição
                                    1: { cellWidth: isFaturamento ? 90 : 70, cellMinHeight: isFaturamento ? 30 : 10, overflow: 'linebreak' },  // Nome/Compromisso/Descrição
                                    2: { cellWidth: isFaturamento ? 20 : 40, cellMinHeight: isFaturamento ? 30 : 10 },  // Status
                                    3: { cellWidth: isFaturamento ? 30 : 50, halign: 'right', cellMinHeight: isFaturamento ? 30 : 10 }  // Valor/Data
                                },
                                margin: { left: 5, right: 5 },
                                tableWidth: 'auto',
                                didParseCell: function(data) {
                                    // Formatação especial para headers e separadores no faturamento
                                    if (isFaturamento) {
                                        // Se a célula está vazia (separador)
                                        if (data.cell.text[0] === '' && data.row.index > 0) {
                                            data.cell.styles.fillColor = [250, 250, 250];
                                            data.cell.styles.minCellHeight = 8;
                                            data.cell.styles.lineWidth = 0;
                                        }
                                        // Se for header (primeira coluna em maiúsculas e negrito)
                                        if (data.row.index > 0 && data.column.index === 0 && 
                                            data.cell.text[0] && typeof data.cell.text[0] === 'string' &&
                                            data.cell.text[0].toUpperCase() === data.cell.text[0] &&
                                            data.cell.text[0].length > 5) {
                                            data.cell.styles.fontStyle = 'bold';
                                            data.cell.styles.fillColor = [235, 235, 235];
                                            data.cell.styles.textColor = [42, 42, 42];
                                            data.cell.styles.fontSize = 11;
                                        }
                                        // Permitir quebra de linha na coluna de descrição
                                        if (data.column.index === 1) {
                                            data.cell.styles.cellMinHeight = 30;
                                            data.cell.styles.overflow = 'linebreak';
                                            // Se for array (múltiplas linhas), garantir altura suficiente
                                            if (Array.isArray(data.cell.text)) {
                                                data.cell.styles.cellMinHeight = data.cell.text.length * 10 + 15;
                                            }
                                        }
                                        // Aumentar espaçamento vertical para todas as células
                                        if (!data.cell.styles.cellPadding || typeof data.cell.styles.cellPadding === 'number') {
                                            data.cell.styles.cellPadding = { top: 12, bottom: 12, left: 8, right: 8 };
                                        }
                                    }
                                }
                            });
                        } else {
                            // Fallback Simples se autoTable não estiver disponível
                            let y = 45;
                            doc.setFontSize(12);
                            doc.text("Dados do Relatório:", 20, y);
                            y += 8;
                            // Aumentar espaçamento entre colunas no fallback
                            const colPositions = [20, 60, 120, 170];
                            head[0].forEach((h, i) => doc.text(h, colPositions[i] || (20 + i * 50), y));
                            y += 5;
                            doc.setLineWidth(0.5);
                            doc.line(20, y, 190, y);
                            y += 5;
                            body.forEach(row => {
                                row.forEach((cell, i) => doc.text(cell, colPositions[i] || (20 + i * 50), y));
                                y += 7;
                            });
                        }

                        doc.save(fileName + '.pdf'); 

                    } else {
                        showToast("ERRO: A biblioteca jsPDF não está pronta. Certifique-se de que os CDNs da jsPDF e do jspdf-autotable foram incluídos corretamente no <head>.", 'error', 6000);
                    }
                }
            });
        });
    });
</script>
</body>
</html>