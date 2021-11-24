import './globals';
import './initializations/taskInspector';

// Import Extensions for Testing Modeler
// import './extensions/twitterConnector';
// import './extensions/testCustomConnector';
// import './extensions/customMarker';
import registerNodes from '@/setup/registerNodes';

const blank = `
    <?xml version="1.0" encoding="UTF-8"?>
    <bpmn:definitions xmlns:bpmn="http://www.omg.org/spec/BPMN/20100524/MODEL" xmlns:bpmndi="http://www.omg.org/spec/BPMN/20100524/DI" xmlns:di="http://www.omg.org/spec/DD/20100524/DI" xmlns:dc="http://www.omg.org/spec/DD/20100524/DC" id="Definitions_03dabax" targetNamespace="http://bpmn.io/schema/bpmn" exporter="Camunda Modeler" exporterVersion="2.0.3">
    <bpmn:process id="Process_1" isExecutable="true"></bpmn:process>
    <bpmndi:BPMNDiagram id="BPMNDiagram_1">
    <bpmndi:BPMNPlane id="BPMNPlane_1" bpmnElement="Process_1"></bpmndi:BPMNPlane>
    </bpmndi:BPMNDiagram>
    </bpmn:definitions>
  `;
const processXML = window.processXML;

window.ProcessMaker.EventBus.$on('modeler-init', (event) => {
  console.log('iniciando');
  registerNodes(event);
});
window.ProcessMaker.EventBus.$on('modeler-start', ({ loadXML }) => {
  if (processXML) {
    loadXML(processXML);
  } else {
    loadXML(blank);
  }
  console.log('iniciado');
});
