
<!--                                            -->
<!-- The original DDI 3.1 Schema can be found at http://www.ddialliance.org/DDI/schema/ddi3.1/ -->
<!--                                         -->
<!-- from Histat 2.0 on <?= date("Y-m-d")?> -->
<!-- DDI3.1 export format                    -->
<!--                                         -->
<!-- Histat 2.0 to DDI 3.1 Export   -->
<!--                                         -->
<ddi:DDIInstance id="gesis_ZA<?= $project->ZA_Studiennummer ?>" agency="de.gesis" version="1.0.0" versionDate="2012-08-20" xmlns:ddi="ddi:instance:3_1" xmlns:s="ddi:studyunit:3_1" xmlns:pd="ddi:physicaldataproduct:3_1" xmlns:pi="ddi:physicalinstance:3_1" xmlns:c="ddi:conceptualcomponent:3_1" xmlns:l="ddi:logicalproduct:3_1" xmlns:r="ddi:reusable:3_1" xmlns:dc="ddi:datacollection:3_1" xmlns:a="ddi:archive:3_1" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:dce="ddi:dcelements:3_1" xmlns:dc2="http://purl.org/dc/elements/1.1/"  xmlns:n1="ddi:physicaldataproduct_ncube_tabular:3_1"  xsi:schemaLocation="ddi:instance:3_1 http://info1.gesis.org/DDI/3_1/instance.xsd">
    <r:Citation>
        <r:Title>DDI3.1 Dokumentation für Studie &apos;<?= HTML::chars($project->Projektname) ?>&apos;</r:Title>
    </r:Citation>
    <s:StudyUnit id="ZA<?= $project->ZA_Studiennummer ?>_SU"  isMaintainable="true" agency="de.gesis" version="1.0.0">
        <r:UserID type="DBK Study Number">ZA<?= $project->ZA_Studiennummer ?></r:UserID>
        <r:Citation>
            <r:Title><?=HTML::chars($project->Projektname) ?></r:Title>
            <?php $authors = explode(";", $project->Projektautor); ?>
            <?php foreach ($authors as $author): ?>
                <r:Creator><?=  HTML::chars($author) ?></r:Creator>
            <?php endforeach; ?>



            <r:Publisher>GESIS - Leibniz Institut für Sozialwissenschaften</r:Publisher>

            <r:Contributor role="Distributor">GESIS - Leibniz Institut für Sozialwissenschaften</r:Contributor>
            <r:InternationalIdentifier type="DOI">doi:10.4232/1.8137</r:InternationalIdentifier>
            <dce:DCElements>
                <dc2:title><?= $project->Projektname ?>
                </dc2:title>
            </dce:DCElements>
        </r:Citation>
        <s:Abstract id="ZA<?= $project->ZA_Studiennummer ?>_A"> 
            <r:Content>
                <?= (HTML::chars($project->Projektbeschreibung)) ?>
            </r:Content>
        </s:Abstract>
        <r:UniverseReference>
            <r:Module>
                <r:ID>ZA<?= $project->ZA_Studiennummer ?>_ConCom</r:ID>
                <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                <r:Version>1.0.0</r:Version>
            </r:Module>
            <r:Scheme>
                <r:ID>ZA<?= $project->ZA_Studiennummer ?>_UniSch</r:ID>
                <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                <r:Version>1.0.0</r:Version>
            </r:Scheme>
            <r:ID>ZA<?= $project->ZA_Studiennummer ?>_Uni</r:ID>
            <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
            <r:Version>1.0.0</r:Version>
        </r:UniverseReference>
        <s:Purpose id="ZA<?= $project->ZA_Studiennummer ?>_P"> 
            <r:Content></r:Content>
        </s:Purpose>
        <r:Coverage>
            <r:TopicalCoverage id="ZA<?= $project->ZA_Studiennummer ?>_Top">
                <r:Subject codeListAgency="de.gesis"  codeListID="ZA-Kategorien">Historische Sozialforschung</r:Subject>
            </r:TopicalCoverage>
            <r:SpatialCoverage id="ZA<?= $project->ZA_Studiennummer ?>_Spa">
                <r:Description>DXDE Deutsches Reich (1871-1945)</r:Description>
                <r:Description>DE Deutschland</r:Description>
                <r:Description>DDDE Deutsche Demokratische Republik (1949-1990)</r:Description>
                <r:TopLevelReference>
                    <r:LevelName>Countries and Regions (ISO3166-1/2)</r:LevelName>
                </r:TopLevelReference>
                <r:LowestLevelReference>
                    <r:LevelName>Countries and Regions (ISO3166-1/2)</r:LevelName>
                </r:LowestLevelReference>
            </r:SpatialCoverage>
            <r:TemporalCoverage id="ZA<?= $project->ZA_Studiennummer ?>_Tem">
                <r:ReferenceDate>
                  <?php $years = explode("-", $project->Zeitraum); ?>
                    <r:StartDate><?= trim($years[0]) ?></r:StartDate>
                    <r:EndDate><?= trim($years[1]) ?></r:EndDate>
                </r:ReferenceDate>
            </r:TemporalCoverage>
        </r:Coverage>
        <r:OtherMaterial type="Publication" id="ZA<?= $project->ZA_Studiennummer ?>_OthMat4816">
            <r:Citation>
                <r:Title><?= HTML::chars($project->Veroeffentlichung) ?></r:Title>
            </r:Citation>
        </r:OtherMaterial>
        <r:OtherMaterial type="Link" id="ZA<?= $project->ZA_Studiennummer ?>_OthMat_Link514">
            <r:Citation>
                <r:Title>Online-Datenbank HISTAT</r:Title>
            </r:Citation>
            <r:ExternalURLReference>http://www.histat.gesis.org</r:ExternalURLReference>
        </r:OtherMaterial>
        <r:Note type="Addendum" id="ZA<?= $project->ZA_Studiennummer ?>_Not">
            <r:Relationship>
                <r:RelatedToReference>
                    <r:ID>ZA<?= $project->ZA_Studiennummer ?>_SU</r:ID>
                    <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                    <r:Version>1.0.0</r:Version>
                </r:RelatedToReference>
            </r:Relationship>
            <r:Header>Weitere Hinweise</r:Header>
            <r:Content></r:Content>
        </r:Note>
        <c:ConceptualComponent id="ZA<?= $project->ZA_Studiennummer ?>_ConCom"  isMaintainable="true" agency="de.gesis" version="1.0.0">
            <c:UniverseScheme id="ZA<?= $project->ZA_Studiennummer ?>_UniSch"  isMaintainable="true" agency="de.gesis" version="1.0.0">
                <c:Universe id="ZA<?= $project->ZA_Studiennummer ?>_Uni"  isVersionable="true" version="1.0.0"> 
                    <c:HumanReadable></c:HumanReadable>
                </c:Universe> 
            </c:UniverseScheme>
        </c:ConceptualComponent>
        <dc:DataCollection id="ZA<?= $project->ZA_Studiennummer ?>_DatCol"  isMaintainable="true" agency="de.gesis" version="1.0.0">
            <dc:Methodology id="ZA<?= $project->ZA_Studiennummer ?>_Met"   isVersionable="true" version="1.0.0">
                <dc:SamplingProcedure id="ZA<?= $project->ZA_Studiennummer ?>_SamPro">
                    <r:Content></r:Content>
                </dc:SamplingProcedure>
            </dc:Methodology>
            <dc:CollectionEvent id="ZA<?= $project->ZA_Studiennummer ?>_ColEve">
                <dc:DataCollectorOrganizationReference>
                    <r:Module>
                        <r:ID>ZA<?= $project->ZA_Studiennummer ?>_Arc</r:ID>
                        <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                        <r:Version>1.0.0</r:Version>
                    </r:Module>
                    <r:Scheme>
                        <r:ID>ZA<?= $project->ZA_Studiennummer ?>_OrgSch</r:ID>
                        <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                        <r:Version>1.0.0</r:Version>
                    </r:Scheme>
                    <r:ID>ZA<?= $project->ZA_Studiennummer ?>_Org_DC</r:ID>
                    <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                    <r:Version>1.0.0</r:Version>
                </dc:DataCollectorOrganizationReference>
                <dc:DataCollectionDate>
                    <?php $years = explode("-", $project->Zeitraum); ?>
                    <r:StartDate><?= trim($years[0]) ?></r:StartDate>
                    <r:EndDate><?= trim($years[1]) ?></r:EndDate>
                </dc:DataCollectionDate>
                <dc:ModeOfCollection id="ZA<?= $project->ZA_Studiennummer ?>_ModOfC">
                    <r:Content>Quantitative Daten zur historischen Statistik
                    </r:Content>
                </dc:ModeOfCollection>
            </dc:CollectionEvent>
        </dc:DataCollection>
        <!-- Dummy Structure - should not be required! -->
        <l:NCubeLogicalProduct id="ZA<?= $project->ZA_Studiennummer ?>_NCubLogPro"  isMaintainable="true" agency="de.gesis" version="1.0.0">
            <l:VariableScheme id="ZA<?= $project->ZA_Studiennummer ?>_VarSch"  isMaintainable="true" agency="de.gesis" version="1.0.0">
                <l:Variable id="ZA<?= $project->ZA_Studiennummer ?>_Var"  isVersionable="true" version="1.0.0"/>
            </l:VariableScheme>
            <l:NCubeScheme id="ZA<?= $project->ZA_Studiennummer ?>_NCubSch"  isMaintainable="true" agency="de.gesis" version="1.0.0">
                <l:NCube dimensionCount="1" id="ZA<?= $project->ZA_Studiennummer ?>_NCub"  isVersionable="true" version="1.0.0">
                    <l:Dimension rank="1">
                        <l:VariableReference>
                            <r:Module>
                                <r:ID>ZA<?= $project->ZA_Studiennummer ?>_SU</r:ID>
                                <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                                <r:Version>1.0.0</r:Version>
                            </r:Module>
                            <r:Scheme>
                                <r:ID>ZA<?= $project->ZA_Studiennummer ?>_VarSch</r:ID>
                                <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                                <r:Version>1.0.0</r:Version>
                            </r:Scheme>
                            <r:ID>ZA<?= $project->ZA_Studiennummer ?>_Var</r:ID>
                            <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                            <r:Version>1.0.0</r:Version>
                        </l:VariableReference>
                    </l:Dimension>
                    <l:Measure id="ZA<?= $project->ZA_Studiennummer ?>_Mea">
                        <l:VariableReference>
                            <r:Module>
                                <r:ID>ZA<?= $project->ZA_Studiennummer ?>_SU</r:ID>
                                <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                                <r:Version>1.0.0</r:Version>
                            </r:Module>
                            <r:Scheme>
                                <r:ID>ZA<?= $project->ZA_Studiennummer ?>_VarSch</r:ID>
                                <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                                <r:Version>1.0.0</r:Version>
                            </r:Scheme>
                            <r:ID>ZA<?= $project->ZA_Studiennummer ?>_Var</r:ID>
                            <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                            <r:Version>1.0.0</r:Version>
                        </l:VariableReference>
                    </l:Measure>
                </l:NCube>
            </l:NCubeScheme>
        </l:NCubeLogicalProduct>
        <!-- End ofDummy Structure - should not be required! -->
        <l:LogicalProduct id="ZA<?= $project->ZA_Studiennummer ?>_LogPro"  isMaintainable="true" agency="de.gesis" version="1.0.0">
            <l:DataRelationship id="ZA<?= $project->ZA_Studiennummer ?>_DatRel"  isVersionable="true" version="1.0.0">
                <l:LogicalRecord hasLocator="false" id="ZA<?= $project->ZA_Studiennummer ?>_LogRec" variableQuantity="0">
                    <l:VariablesInRecord allVariablesInLogicalProduct="true"></l:VariablesInRecord>
                </l:LogicalRecord>
            </l:DataRelationship>
        </l:LogicalProduct>
        <pd:PhysicalDataProduct id="ZA<?= $project->ZA_Studiennummer ?>_PhyDatPro"  isMaintainable="true" agency="de.gesis" version="1.0.0">
            <pd:PhysicalStructureScheme id="ZA<?= $project->ZA_Studiennummer ?>_PhyStrSch"  isMaintainable="true" agency="de.gesis" version="1.0.0">
                <pd:PhysicalStructure id="ZA<?= $project->ZA_Studiennummer ?>_PhyStr"  isVersionable="true" version="1.0.0">
                    <pd:LogicalProductReference>
                        <r:ID>ZA<?= $project->ZA_Studiennummer ?>_LogPro</r:ID>
                        <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                        <r:Version>1.0.0</r:Version>
                    </pd:LogicalProductReference>
                    <pd:Format>Excel</pd:Format>
                    <pd:GrossRecordStructure id="ZA<?= $project->ZA_Studiennummer ?>_GroRecStr">
                        <pd:LogicalRecordReference>
                            <r:Module>
                                <r:ID>ZA<?= $project->ZA_Studiennummer ?>_LogPro</r:ID>
                                <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                                <r:Version>1.0.0</r:Version>
                            </r:Module>
                            <r:Scheme>
                                <r:ID>ZA<?= $project->ZA_Studiennummer ?>_LogPro</r:ID>
                                <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                                <r:Version>1.0.0</r:Version>
                            </r:Scheme>
                            <r:ID>ZA<?= $project->ZA_Studiennummer ?>_LogRec</r:ID>
                            <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                            <r:Version>1.0.0</r:Version>
                        </pd:LogicalRecordReference>
                        <pd:PhysicalRecordSegment id="ZA<?= $project->ZA_Studiennummer ?>_PhyRecSeg"></pd:PhysicalRecordSegment>
                    </pd:GrossRecordStructure>
                </pd:PhysicalStructure>
            </pd:PhysicalStructureScheme>
            <!-- Dummy Structure - should not be required! -->
            <pd:RecordLayoutScheme id="ZA<?= $project->ZA_Studiennummer ?>_RecLaySch" isMaintainable="true" agency="de.gesis" version="1.0.0">
                <n1:RecordLayout id="ZA<?= $project->ZA_Studiennummer ?>_RecLay" isVersionable="true" version="1.0.0">
                    <pd:PhysicalStructureReference>
                        <r:Module>
                            <r:ID>ZA<?= $project->ZA_Studiennummer ?>_PhyDatPro</r:ID>
                            <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                            <r:Version>1.0.0</r:Version>
                        </r:Module>
                        <r:Scheme>
                            <r:ID>ZA<?= $project->ZA_Studiennummer ?>_PhyStrSch</r:ID>
                            <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                            <r:Version>1.0.0</r:Version>
                        </r:Scheme>
                        <r:ID>ZA<?= $project->ZA_Studiennummer ?>_PhyStr</r:ID>
                        <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                        <r:Version>1.0.0</r:Version>
                        <!-- Dummy Element - should not be required! -->
                        <pd:PhysicalRecordSegmentUsed>ZA<?= $project->ZA_Studiennummer ?>_PhyRecSeg</pd:PhysicalRecordSegmentUsed>
                    </pd:PhysicalStructureReference>
                    <n1:CharacterSet/>
                    <n1:ArrayBase>0</n1:ArrayBase>
                    <n1:NCubeInstance id="ZA<?= $project->ZA_Studiennummer ?>_NCubIns" isVersionable="true" version="1.0.0">
                        <n1:NCubeReference>
                            <r:Module>
                                <r:ID>ZA<?= $project->ZA_Studiennummer ?>_LogPro</r:ID>
                                <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                                <r:Version>1.0.0</r:Version>
                            </r:Module>
                            <r:Scheme>
                                <r:ID>ZA<?= $project->ZA_Studiennummer ?>_LogPro</r:ID>
                                <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                                <r:Version>1.0.0</r:Version>
                            </r:Scheme>
                            <r:ID>ZA<?= $project->ZA_Studiennummer ?>_LogRec</r:ID>
                            <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                            <r:Version>1.0.0</r:Version>
                        </n1:NCubeReference>
                        <n1:DataItem>
                            <n1:Measure>
                                <n1:MeasureReference>
                                    <r:Module>
                                        <r:ID>ZA<?= $project->ZA_Studiennummer ?>_LogPro</r:ID>
                                        <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                                        <r:Version>1.0.0</r:Version>
                                    </r:Module>
                                    <r:Scheme>
                                        <r:ID>ZA<?= $project->ZA_Studiennummer ?>_LogPro</r:ID>
                                        <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                                        <r:Version>1.0.0</r:Version>
                                    </r:Scheme>
                                    <r:ID>ZA<?= $project->ZA_Studiennummer ?>_LogRec</r:ID>
                                    <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                                    <r:Version>1.0.0</r:Version>
                                </n1:MeasureReference>
                                <n1:PhysicalTableLocation>
                                    <n1:Column>0</n1:Column>
                                </n1:PhysicalTableLocation>
                            </n1:Measure>
                        </n1:DataItem>
                    </n1:NCubeInstance>
                    <n1:TopLeftTableAnchor row="0" column="0"/>
                </n1:RecordLayout>
            </pd:RecordLayoutScheme>
            <!-- End ofDummy Structure - should not be required! -->
        </pd:PhysicalDataProduct>
        <pi:PhysicalInstance id="ZA<?= $project->ZA_Studiennummer ?>_PhyIns" version="1.0.0" versionDate="2010-04-13" isMaintainable="true" agency="de.gesis">
            <pi:RecordLayoutReference>
                <r:Module>
                    <r:ID>ZA<?= $project->ZA_Studiennummer ?>_PhyDatPro</r:ID>
                    <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                    <r:Version>1.0.0</r:Version>
                </r:Module>
                <r:Scheme>
                    <r:ID>ZA<?= $project->ZA_Studiennummer ?>_RecLaySch</r:ID>
                    <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                    <r:Version>1.0.0</r:Version>
                </r:Scheme>
                <r:ID>ZA<?= $project->ZA_Studiennummer ?>_RecLay</r:ID>
                <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                <r:Version>1.0.0</r:Version>
            </pi:RecordLayoutReference>
            <pi:DataFileIdentification id="ZA<?= $project->ZA_Studiennummer ?>_DatFilIde">
                <pi:URI isPublic="true">doi:10.4232/1.8137</pi:URI>
            </pi:DataFileIdentification>
            <pi:GrossFileStructure id="ZA<?= $project->ZA_Studiennummer ?>_GroFilStr">
                <pi:CaseQuantity>0</pi:CaseQuantity>
            </pi:GrossFileStructure>
        </pi:PhysicalInstance>
        <a:Archive id="ZA<?= $project->ZA_Studiennummer ?>_Arc"  isMaintainable="true" agency="de.gesis" version="1.0.0">
            <a:ArchiveSpecific>
                <a:ArchiveOrganizationReference>
                    <r:Module>
                        <r:ID>ZA<?= $project->ZA_Studiennummer ?>_Arc</r:ID>
                        <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                        <r:Version>1.0.0</r:Version>
                    </r:Module>
                    <r:Scheme>
                        <r:ID>ZA<?= $project->ZA_Studiennummer ?>_OrgSch</r:ID>
                        <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                        <r:Version>1.0.0</r:Version>
                    </r:Scheme>
                    <r:ID>ZA<?= $project->ZA_Studiennummer ?>_Org_AR</r:ID>
                    <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                    <r:Version>1.0.0</r:Version>
                </a:ArchiveOrganizationReference>
                <a:Item>
                    <a:CallNumber>ZA<?= $project->ZA_Studiennummer ?></a:CallNumber>
                    <a:Access id="ZA<?= $project->ZA_Studiennummer ?>_Acc">
                        <a:AccessTypeName>A</a:AccessTypeName>
                        <r:Description>Daten und Dokumente sind für die akademische Forschung und Lehre freigegeben.</r:Description>
                        <a:CitationRequirement>doi:10.4232/1.8137</a:CitationRequirement>
                        <a:AccessConditions>Daten und Dokumente sind für die akademische Forschung und Lehre freigegeben.</a:AccessConditions>
                    </a:Access>
                </a:Item>
            </a:ArchiveSpecific>
            <a:OrganizationScheme id="ZA<?= $project->ZA_Studiennummer ?>_OrgSch"  isMaintainable="true" agency="de.gesis" version="1.0.0">
                <a:Organization id="ZA<?= $project->ZA_Studiennummer ?>_Org_AR"  isVersionable="true" version="1.0.0">
                    <a:OrganizationName>GESIS - Leibniz Institut für Sozialwissenschaften</a:OrganizationName>
                    <a:Nickname>GESIS</a:Nickname>
                    <a:URL>http://www.gesis.org/</a:URL>
                </a:Organization>
                <a:Organization id="ZA<?= $project->ZA_Studiennummer ?>_Org_DC"  isVersionable="true" version="1.0.0">
                    <a:OrganizationName><?=  HTML::chars($project->Projektautor) ?>

                    </a:OrganizationName>
                </a:Organization>
            </a:OrganizationScheme>
            <r:LifecycleInformation>
                <r:LifecycleEvent id="ZA<?= $project->ZA_Studiennummer ?>_LifEve">
                    <r:Date>
                        <r:SimpleDate><?= date('Y-m-d', time()) ?></r:SimpleDate>
                    </r:Date>
                    <r:AgencyOrganizationReference>
                        <r:Module>
                            <r:ID>ZA<?= $project->ZA_Studiennummer ?>_Arc</r:ID>
                            <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                            <r:Version>1.0.0</r:Version>
                        </r:Module>
                        <r:Scheme>
                            <r:ID>ZA<?= $project->ZA_Studiennummer ?>_OrgSch</r:ID>
                            <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                            <r:Version>1.0.0</r:Version>
                        </r:Scheme>
                        <r:ID>ZA<?= $project->ZA_Studiennummer ?>_Org_AR</r:ID>
                        <r:IdentifyingAgency>de.gesis</r:IdentifyingAgency>
                        <r:Version>1.0.0</r:Version>
                    </r:AgencyOrganizationReference>
                    <r:Description>Histat 2.0 nach DDI 3.1 Export</r:Description>
                </r:LifecycleEvent>
            </r:LifecycleInformation>
        </a:Archive>
    </s:StudyUnit>
</ddi:DDIInstance>
